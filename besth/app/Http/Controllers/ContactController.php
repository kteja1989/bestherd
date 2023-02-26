<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//use Mail;
use App\Mail\ContactMailer;
use App\Mail\ContactReplyMailer;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

//for sendgrid api mail
use \SendGrid\Mail\Mail;


class ContactController extends Controller
{
    public function takeMessage(ContactRequest $request)
    {
        $input = $request->only(['name', 'email', 'nterms', 'botcheck']);
        //dd($input);
        
        if( $input['nterms'] == 'on')
        {
            if( $input['botcheck'] == null)
            {
                
                $email = new Mail();
                
                //email address and name of your verified sender
                $email->setFrom(config('sendgrid.mail_from_address'), config('sendgrid.mail_from_name'));
                
                $email->setSubject(config('sendgrid.brochure_subject'));
                
                //email address and name to system administration
                $email->addTo(
                    'mvksastry@gmail.com', 
                    'Krishna Sastry'
                );
                
                $email->addContent(
                    'text/html',
                    'Name: '.$input['name'].'</br>'.'From: '.$input['email']
                );
                
                //set the api key
                $sendgrid = new \SendGrid(config('sendgrid.sg_api_key'));
                
                //uncomment below to check all data before go
                //dd($email, $sendgrid);
                
                // all set and ready to go
                try {
                    $response = $sendgrid->send($email);
                    //printf("Response status: %d\n\n", $response->statusCode());
                    Log::channel('contactmail')->info('New Contact Mail Received', ['name' => $input['name'], 'email' => $input['email'], 'response' => $response->statusCode() ]);
                    //$headers = array_filter($response->headers());
                    //echo "Response Headers\n\n";
                    //foreach ($headers as $header) {
                    //    echo '- ' . $header . "\n";
                    //}
                    //$msg = "Message Posted. Will contact soon. Thank you";
                    //return view('landing.mailReply')->with(['msg' => $msg]);
                } catch (Exception $e) {
                    //echo 'Caught exception: '. $e->getMessage() ."\n";
                    Log::channel('contactmail')->info('New Contact Failed', ['exception' => $e->getMessage() ]);
                }
                
                //now send a return mail with brochure to the sender
                $remail = new Mail();
                
                // set the email address and name: the authorized sender
                $remail->setFrom(config('sendgrid.mail_from_address'), config('sendgrid.mail_from_name'));
                
                $remail->setSubject(config('sendgrid.brochure_reqreply_subject'));
                
                // Set the email address and name of recipient
                $remail->addTo($input['email'], $input['name'] );
                
                //set the template and data
                $remail->setTemplateId(config('sendgrid.brochure_reply_template_id'));
                $remail->addDynamicTemplateData("to_name", $input['name']);
                
                $base_path = "/home/oj6zw70lken1/public_html/";
                
                //add the pdf brochure attachment
                $file_encoded = base64_encode(file_get_contents($base_path.config('sendgrid.brochure_file')));
                $remail->addAttachment(
                   $file_encoded,
                   "application/pdf",
                   "Meissa-BESTBroucher.pdf",
                   "attachment"
                );
                
                //everything complete, now send the mail through sendgrid
                $sendgrid = new \SendGrid(config('sendgrid.sg_api_key'));
                
                //dd($remail, $sendgrid);
                
                // everything set and ready to go.
                try {
                    
                    $response = $sendgrid->send($remail);
                    //printf("Response status: %d\n\n", $response->statusCode());
                    Log::channel('contactmail')->info('Brochure Sent', ['name' => $input['name'], 'email' => $input['email'], 'response' => $response->statusCode() ]);
                    //$headers = array_filter($response->headers());
                    //echo "Response Headers\n\n";
                    //foreach ($headers as $header) {
                    //    echo '- ' . $header . "\n";
                    //}
                    $msg = "Brochure with login credentials sent. Thank you";
                } catch (Exception $e) {
                    //echo 'Caught exception: '. $e->getMessage() ."\n";
                    Log::channel('contactmail')->info('Brochure sent failed', ['exception' => $e->getMessage() ]);
                    $msg = "Brochure Could not be sent, try again. Thank you";
                }
                
                //////////////////////////////////
                
                /*
                //first save the contact in contacts table
                $newContact = new Contact();
                $newContact->name = $input['name'];
                $newContact->email = $input['email'];
                $newContact->message = "Send brochure and login credentials";
                $newContact->status = "Received";
                $newContact->save();
                
                //compose mail to team meissa-best
                Mail::to("tejak007@gmail.com")->queue(new ContactMailer($newContact));
                Log::channel('contactmail')->info('New Contact Mail Received', ['name' => $newContact->name, 'email' => $newContact->email ]);
                
                //now compose and send mail to sender with brochure and login credentials
                Mail::to($input['email'])->queue(new ContactReplyMailer($newContact));
                Log::channel('contactmail')->info('Brochure Sent with mail', ['name' => $newContact->name, 'email' => $newContact->email ]);
                $msg = "Brochure with login credentials sent. Thank you";
                */
            }
        }
        return view('landing.mailReply')->with(['msg' => $msg]);
    }
}
