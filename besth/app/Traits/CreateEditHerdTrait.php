<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Herd;

use App\Traits\Base;

use Illuminate\Support\Facades\Validator;

trait CreateEditHerdTrait
{
    use Base;

    public function makeNewHerdEntry()
    {
        $validatedData = $this->validate(
        [   'herdColor'      => 'required|alpha',
            'herd_gender'    => 'required|alpha',
            'herd_category'  => 'required|alpha',
            'herd_size'      => 'required|numeric|min:1|max:100',
            'herd_desc'      => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
            'herd_location'  => 'required|string|regex:/^[A-Za-z0-9-_. ]+$/',
            'herd_incharge'  => 'required|string|regex:/^[A-Za-z0-9_. ]+$/',
            'feed_id'        => 'required|string|regex:/^[A-Za-z0-9_. ]+$/'
        ],
        [
            'herdColor.required'            => 'Error: The :attribute cannot be empty.',
            'herdColor.herdColor'           => 'Error: The :attribute must be letters only.',
            'herd_category.required'        => 'Error: The :attribute cannot be empty.',
            'herd_category.herd_category'   => 'Error: The :attribute must be letters only.',
            'herd_gender.required'          => 'Error: The :attribute cannot be empty.',
            'herd_gender.herd_gender'       => 'Error: The :attribute must be letters only.',
            'herd_size.required'            => 'Error: The :attribute cannot be empty.',
            'herd_size.herd_size'           => 'Error: The :attribute must be Numbers only.',
            'herd_desc.required'            => 'Error: The :attribute cannot be empty.',
            'herd_desc.herd_desc'           => 'Error: The :attribute must be Letters and Dash only.',
            'herd_location.required'        => 'Error: The :attribute cannot be empty.',
            'herd_location.herd_location'   => 'Error: The :attribute must be Letters and Dash only.',
            'herd_incharge.required'        => 'Error: The :attribute cannot be empty.',
            'herd_incharge.herd_incharge'   => 'Error: The :attribute must be Letters and Dash only.',
            'feed_id.required'              => 'Error: The :attribute cannot be empty.',
            'feed_id.feed_id'               => 'Error: The :attribute must be Letters and Dash only.',
        ],
        [
            'herdColor'     => 'Herd Color',
            'herd_category' => 'Herd Category',
            'herd_gender'   => 'Herd Gender',
            'herd_size'     => 'Herd Size',
            'herd_desc'     => 'Herd Description',
            'herd_location' => 'Herd Location',
            'herd_incharge' => 'Herd In-Charge',
            'feed_id'       => 'Feed'
        ]);

        $addHerd = new Herd();
        $addHerd->category = $this->herd_category;
        $addHerd->color = $this->herdColor;
        $addHerd->description = $this->herd_desc;
        $addHerd->location = $this->herd_location;
        $addHerd->total_size = $this->herd_size;
        $addHerd->total_count = 0;
        $addHerd->gender = $this->herd_gender;
        $addHerd->feed_description = $this->feed_id;
        $addHerd->incharge_name = $this->herd_incharge;
        $addHerd->status = 'active';
        //dd($addHerd);
        $addHerd->save();
    
        
        return $validatedData;
    }
    
}