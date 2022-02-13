<?php

namespace App\Http\Livewire;

use App\Models\faq;
use Livewire\Component;

class UnarchiveFaqs extends Component
{
    public function unArchiveFaq($id)
    {
        $faq = faq::findOrFail($id);
        $faq->archived = 0;
        $faq->update();
    }

    public function render()
    {
        $faqs = faq::where('archived', 1)
            ->paginate(10);
        return view('livewire.unarchive-faqs', compact('faqs'));
    }
}
