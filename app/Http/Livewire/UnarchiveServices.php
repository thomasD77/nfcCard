<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UnarchiveServices extends Component
{

    public function unArchiveService($id)
    {
        $service = Service::findOrFail($id);
        $service->archived = 0;
        $service->update();

    }

    public function render()
    {
        $services = Service::with(['servicecategory'])
            ->where('archived', 1)
            ->latest()
            ->paginate(10);
        return view('livewire.unarchive-services', compact('services'));
    }
}
