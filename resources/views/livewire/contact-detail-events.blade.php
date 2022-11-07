<div>
    <!-- Events -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Events</h3>
        </div>
        <div class="block-content">
            <p class="alert alert-dark fs-sm">
                <i class="fa fa-fw fa-info me-1"></i> Select the event(s) for this contact.
            </p>
            <div class="form-group mb-4">
                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateEventContact', $contact]]) !!}
                    @csrf
                    {!! Form::select('events[]',$events, $ex_events ,['class'=>'form-control', 'multiple'=> 'multiple', 'placeholder'=>'Select event...'])!!}
                    <div class="my-4">
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- END Events -->
</div>
