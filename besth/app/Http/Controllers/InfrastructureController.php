<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Infrastructure;

use App\Http\Requests\InfrastructureFormRequest;

use App;
use File;

use Carbon\Carbon;
use Illuminate\Log\Logger;
use Log;


class InfrastructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $infra = Infrastructure::all();
        return view('infrastructure.index')->with('infra', $infra);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infrastructure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InfrastructureFormRequest $request)
    {
        $input = $request->all();

        $infra = new Infrastructure();
        $infra->name = $input['name'];
        $infra->nickName = $input['nickname'];
        $infra->description = $input['desc'];
        $infra->date_acquired = $input['dateacqrd'];
        $infra->make = $input['make'];
        $infra->model = $input['model'];
        $infra->vendor_address = $input['vendor'];
        $infra->vendor_phone = $input['phone'];
        $infra->vendor_email = $input['email'];
        $infra->building = $input['building'];
        $infra->floor = $input['floor'];
        $infra->room = $input['room'];
        $infra->amc = $input['amc'];
        $infra->amc_start = $input['amcstart'];
        $infra->amc_end = $input['amcend'];
        $infra->supervisor = $input['supervisor'];
        //dd($infra);

        $result = $infra->save();

        return redirect()->route('infrastructure.index')
            ->with('flash_message',
             'Infrastructure entry successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infra = Infrastructure::with('user')->where('infra_id', $id)->first();
        return view('infrastructure.nedit')->with('infra', $infra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $infra = Infrastructure::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
