<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Mail\shareVcard;

class VcardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('made it');
        return view('users.create');
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
            'name_first' => 'required',
            'name_last' => 'required'
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
        $request->session()->flash('status', 'Contact created!');
        $vcard->save();
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
        $vcard = \App\Vcard::find($id);
        if (old('_token'))
        {
            $vcard->name_first = old('name_first');
            $vcard->name_middle = old('name_middle');
            $vcard->name_last = old('name_last');
            $vcard->organization_name = old('organization_name');
            $vcard->organization_title = old('organization_title');
            $vcard->phone_home = old('phone_home');
            $vcard->phone_work = old('phone_work');
            $vcard->phone_cell = old('phone_cell');
            $vcard->address_work = old('address_work');
            $vcard->address_home = old('address_home');
            $vcard->email_personal = old('email_personal');
            $vcard->email_work = old('email_work');
        }

        return view('users.edit', compact('vcard'));
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
        $validatedData = $request->validate([
            'name_first' => 'required',
            'name_last' => 'required'
        ]);
        $input = $request->input();
        $vcard = \App\Vcard::find($id);
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
        $request->session()->flash('status', 'Contact updated!');
        $vcard->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $vcard = \App\Vcard::find($id);
        $vcard->delete();
        $request->session()->flash('status', 'Contact deleted!');
        return redirect()->route('home');
    }

    public function share(Request $request, $id)
    {
        // $email = $request->email;

        \Mail::to('theerikwolfe@gmail.com')->send(new shareVcard);

        $request->session()->flash('status', 'Vcard shared!');
        return redirect()->route('home');

    }
}
