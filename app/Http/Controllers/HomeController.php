<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = \App\Contact::where('user_id', '=', \Auth::user()->id)->get();

        foreach($contacts as $contact)
        {
            $contact->vcardInfo = \App\Vcard::where('id', '=', $contact->vcard_id)->first();
        }

        // dd($contacts);

        return view('users.home', compact('contacts'));
    }
}
