<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Testimonials extends Component
{
    public function archiveTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->archived = 1;
        $testimonial->update();

    }

    public function render()
    {
        $testimonials = Testimonial::where('archived', 0)
            ->paginate(10);
        return view('livewire.testimonials', compact('testimonials'));
    }
}
