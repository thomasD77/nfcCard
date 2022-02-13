<?php

namespace App\Http\Livewire;

use App\Models\faq;
use Livewire\Component;

class Faqs extends Component
{
    public function archiveFaq($id)
    {
        $faq = faq::findOrFail($id);
        $faq->archived = 1;
        $faq->update();
    }

    public function render()
    {
        $faqs = faq::where('archived', 0)->paginate(20);
        return view('livewire.faqs', compact('faqs'));
    }
}
