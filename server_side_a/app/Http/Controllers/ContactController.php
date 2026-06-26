<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    // renders the list of contacts to the administrator
    public function index()
    {
        $contacts = \App\Models\Contact::all();
        return view('contact.index', compact('contacts'));
    }
}
