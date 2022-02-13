<?php

namespace App\Http\Livewire;

use App\Models\client;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class UnarchiveClients extends Component
{
    public function unArchiveClient($id)
    {
        $client = User::findOrFail($id);
        $client->archived = 0;
        $client->update();
    }

    public function render()
    {
        $role = ['client'];

        $clients = User::whereHas('roles', function($q) use($role) {
            $q->whereIn('name', $role);})
            ->where('archived', 1)
            ->latest()
            ->paginate(10);

        return view('livewire.unarchive-clients', compact('clients'));
    }
}
