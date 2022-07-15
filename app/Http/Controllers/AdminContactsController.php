<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class AdminContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.contacts.index');
    }

    public function indexClients(User $user)
    {
        //
        $list_user = $user;
        return view('admin.contacts.index-client', compact('list_user'));
    }

    public function archive()
    {
        $contacts = Contact::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('admin.contacts.archive', compact('contacts'));
    }

    public function archiveClients()
    {
        $contacts = Contact::where('archived', 1)
            ->latest()
            ->paginate(25);

        return view('admin.contacts.archive-client', compact('contacts'));
    }
}
