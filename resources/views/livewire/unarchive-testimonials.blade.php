<div class="parent">
    @include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">City</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($testimonials)
            @foreach($testimonials as $testimonial)
                <tr>
                    <td>{{$testimonial->id ? $testimonial->id : 'No ID'}}</td>
                    <td>{{$testimonial->firstname ? $testimonial->firstname : 'No Name'}}</td>
                    <td>{{$testimonial->lastname ? $testimonial->lastname : 'No Name'}}</td>
                    <td>{{$testimonial->city ? $testimonial->city : 'No City'}}</td>
                    <td>
                        <a href="{{route('testimonials.show', $testimonial->id)}}">
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show testimonial">
                                <i class="far fa-eye"></i>
                            </button>
                        </a>
                        <button class="btn btn-sm btn-alt-secondary"
                                wire:click="unArchiveTestimonial({{$testimonial->id}})">
                            <i class="si si-refresh "></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $testimonials->links()  !!}
</div>

