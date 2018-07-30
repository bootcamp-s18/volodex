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
        $vcards = \App\Vcard::where('user_id', '=', \Auth::id())->orderBy('name_first', 'asc')->get();

        // foreach($contacts as $contact)
        // {
        //     $contact->vcardInfo = \App\Vcard::where('id', '=', $contact->vcard_id)->first();
        // }

        // dd($contacts);

        // dd($vcards);
        return view('users.home', compact('vcards'));
    }
}
