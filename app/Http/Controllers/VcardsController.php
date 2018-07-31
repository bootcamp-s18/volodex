<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Mail\shareVcard;

use JeroenDesloovere\VCard\VCard;

use JeroenDesloovere\VCard\VCardParser;

use Illuminate\Support\Facades\Storage;



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
        $user = \Auth::user()->name;
        $vcard = new Vcard();
        $data = \App\Vcard::find($id);

        // add personal data
        $vcard->addName($data->name_last, $data->name_first, $data->name_middle);


        // add work data
        $vcard->addCompany($data->organization_name);
        $vcard->addJobtitle($data->organization_title);
        $vcard->addEmail($data->email_personal, 'HOME');
        $vcard->addEmail($data->email_work, 'WORK');
        $vcard->addPhoneNumber($data->phone_home, 'PREF;HOME');
        $vcard->addPhoneNumber($data->phone_cell, 'CELL');
        $vcard->addPhoneNumber($data->phone_work, 'WORK');
        $vcard->addAddress($data->address_home);
        $vcard->addAddress($data->address_work);
        $vcard->save();

        \Mail::to($request->input('share_email'))->send(new shareVcard($user));

        $file= glob('*.vcf')[0];
        $filename = public_path().'/'.$file;
        unlink($filename);

        $request->session()->flash('status', 'Vcard shared!');
        return redirect()->route('home');

    }

    public function download(Request $request, $id)
    {
        $vcard = new Vcard();
        $data = \App\Vcard::find($id);

        // add personal data
        $vcard->addName($data->name_last, $data->name_first, $data->name_middle);

        // add work data
        $vcard->addCompany($data->organization_name);
        $vcard->addJobtitle($data->organization_title);
        $vcard->addEmail($data->email_personal, 'HOME');
        $vcard->addEmail($data->email_work, 'WORK');
        $vcard->addPhoneNumber($data->phone_home, 'PREF;HOME');
        $vcard->addPhoneNumber($data->phone_cell, 'CELL');
        $vcard->addPhoneNumber($data->phone_work, 'WORK');
        $vcard->addAddress($data->address_home);
        $vcard->addAddress($data->address_work);
        return $vcard->download();

    }

    public function storeUpload(Request $request)
    {

        $vcardString = file_get_contents($request->file('vcardupload'));
        $parser = new VCardParser($vcardString);

        $parser = $parser->getCardAtIndex(0);

        $vcard = new \App\Vcard;
        $vcard->user_id = \Auth::id();
        $vcard->name_first = ( array_key_exists ( 'firstname', $parser ) ?  $parser->firstname : null);
        $vcard->name_last = ( array_key_exists ( 'lastname', $parser ) ? $parser->lastname : null);
        $vcard->organization_name = ( array_key_exists ( 'organization', $parser ) ? $parser->organization : null);
        $vcard->organization_title = ( array_key_exists ( 'title', $parser ) ? $parser->title : null);

        if (array_key_exists( 'phone', $parser)) {
            $vcard->phone_home = ( array_key_exists ( 'PREF;HOME', $parser->phone ) ? $parser->phone["PREF;HOME"][0] : null);
            $vcard->phone_work = ( array_key_exists ( 'WORK', $parser->phone ) ? $parser->phone["WORK"][0] : null);
            $vcard->phone_cell = ( array_key_exists ( 'CELL', $parser->phone ) ?  $parser->phone["CELL"][0] : null);
        }

        if (array_key_exists( 'address', $parser)) {
            $vcard->address_work = ( array_key_exists ( 'name', $parser->address["WORK;POSTAL"][0] ) ? $parser->address["WORK;POSTAL"][0]->name : null);
            $vcard->address_home = ( array_key_exists ( 'name', $parser->address["WORK;POSTAL"][1] ) ? $parser->address["WORK;POSTAL"][1]->name : null);
        }
        if (array_key_exists( 'email', $parser)) {
            $vcard->email_personal = ( array_key_exists ( 'INTERNET;HOME', $parser->email ) ? $parser->email["INTERNET;HOME"][0] : null);
            $vcard->email_work = ( array_key_exists ( 'INTERNET;WORK', $parser->email ) ? $parser->email["INTERNET;WORK"][0] : null);
        }

        $request->session()->flash('status', 'Contact Uploaded!');
        $vcard->save();

        return redirect()->route('home');
    }

}
