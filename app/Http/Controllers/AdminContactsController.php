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
        $count = Contact::where('archived', '=', 0)->count();
        return view('admin.contacts.index', compact('count'));
    }

    public function indexClient(User $user)
    {
        //
        $user = $user;

        $count = \App\Models\Contact::with(['member'])
            ->where('archived', 0)
            ->where('member_id', $user->member_id)
            ->count();

        return view('admin.contacts.index-client', compact('user', 'count'));
    }

    public function archive()
    {
        $contacts = Contact::where('archived', 1)
            ->latest()
            ->paginate(25);

        $count = Contact::where('archived', '=', 1)->count();

        return view('admin.contacts.archive', compact('contacts', 'count'));
    }

    public function archiveClients()
    {

        return view('admin.contacts.archive-client');
    }


    public function archiveTeamContacts()
    {

        return view('admin.contacts.archive-teams-contacts');
    }
}
