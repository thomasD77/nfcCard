<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UnarchiveTestimonials extends Component
{
    public function unArchiveTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->archived = 0;
        $testimonial->update();

    }

    public function render()
    {
        $testimonials = Testimonial::where('archived', 1)
            ->paginate(10);
        return view('livewire.unarchive-testimonials', compact('testimonials'));
    }

}
