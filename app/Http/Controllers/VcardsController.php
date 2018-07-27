<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VcardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vcards = \App\Vcard::where('user_id', '=', \Auth::id())->get();

        return view('users.home', compact('vcards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $input = $request->input();
        $vcard = new \App\Vcard;
        $vcard->user_id = \Auth::id();
        $vcard->name_first = $input['name_first'];
        $vcard->name_middle = $input['name_middle'];
        $vcard->name_last = $input['name_last'];

        $vcard->organization_name = $input['organization_name'];
        $vcard->organization_title = $input['organization_title'];

        $vcard->phone_home = $input['phone_home'];
        $vcard->phone_work = $input['phone_work'];
        $vcard->phone_cell = $input['phone_cell'];

        $vcard->address_work = $input['address_work'];
        $vcard->address_home = $input['address_home'];


        $vcard->email_personal = $input['email_personal'];
        $vcard->email_work = $input['email_work'];

        $vcard->created_at = Carbon::now();
        $vcard->updated_at = Carbon::now();

        $request->session()->flash('status', 'Contact created!');
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vcard = \App\Vcard::find($id);

        $vcard->delete;
        $request->session()->flash('status', 'Contact deleted!');
        return redirect()->route('home');
    }
}
