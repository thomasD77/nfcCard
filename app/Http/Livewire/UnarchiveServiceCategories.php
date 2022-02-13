<?php

namespace App\Http\Livewire;

use App\Models\ServiceCategory;
use Livewire\Component;

class UnarchiveServiceCategories extends Component
{
    public function unArchiveServiceCategory($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->archived = 0;
        $category->update();
    }

    public function render()
    {
        $servicecategories = ServiceCategory::where('archived', 1)
            ->paginate(10);
        return view('livewire.unarchive-service-categories', compact('servicecategories'));
    }
}
