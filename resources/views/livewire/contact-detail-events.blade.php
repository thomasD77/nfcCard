<div>
    <!-- Events -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Events</h3>
        </div>
        <div class="block-content">

            @if($events)
                @foreach($events as $event)
                    <div class="card shadow my-3" style="border: none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9 py-2 mt-4">
                                    {{ $event->name }}
                                </div>
                                <div class="col-lg-2 d-none d-lg-block text-center py-2 mt-4">
                                    <strong>{{ \Carbon\Carbon::parse($event->date)->format('d-M-Y') }}</strong>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-end py-2 mt-4">
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalNotes{{$event->id}}">
                                            <i class="si si-pencil"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalNotes{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateEventContact',$event->id]]) !!}
                                                        @csrf
                                                        <div class="my-4 col-md-4">
                                                            <label for=""><strong>When?</strong></label>
                                                            <input type="date"
                                                                   class="form-control"
                                                                   name="date"
                                                                   value="{{ $event->date }}"
                                                            >
                                                            @error('date')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="my-4">
                                                            <label for=""><strong>Where?</strong></label>
                                                            <textarea type="text"
                                                                      class="form-control"
                                                                      placeholder="Type your location/memories"
                                                                      rows="4"
                                                                      name="event"
                                                            >{{ $event->name }}</textarea>
                                                            @error('event')
                                                            <p class="text-danger mt-2"> {{ $message }}</p>
                                                            @enderror
                                                        </div>

                                                        <div class="my-4">
                                                            <button type="submit" class="btn btn-alt-primary">Update</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@deleteEventContact',$event->id]]) !!}
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-alt-danger"  data-bs-toggle="tooltip" title="Delete">
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            <div class="d-flex justify-content-center my-4">
                {{ $events->links() }}
            </div>

            <p class="alert alert-dark fs-sm">
                <i class="fa fa-fw fa-info me-1"></i> From where/when do you know this contact?
            </p>

            {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@createEventContact',$contact->id]]) !!}
            @csrf
            <div class="my-4 col-md-4">
                <label for=""><strong>When?</strong></label>
                <input type="date"
                       class="form-control"
                       name="date"
                >
                @error('date')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="my-4">
                <label for=""><strong>Where?</strong></label>
                <textarea type="text"
                          class="form-control"
                          placeholder="Type your location/memories"
                          rows="4"
                          name="event"
                ></textarea>
                @error('event')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">Add Event</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <!-- END Events -->
</div>
