<div>
    <!-- Private Notes -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Private Notes</h3>
        </div>
        <div class="block-content">

            @if($notes)
                @foreach($notes as $note)
                    <div class="card shadow my-3" style="border: none">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9 py-2 mt-4">
                                    {{ $note->name }}
                                </div>
                                <div class="col-lg-2 d-none d-lg-block text-center py-2 mt-4">
                                    <strong>{{ $note->created_at->format('d-M-Y') }}</strong>
                                </div>
                                <div class="col-lg-1 d-flex justify-content-end py-2 mt-4">
                                    <div>


                                        <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalNotes{{$note->id}}">
                                            <i class="si si-pencil"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalNotes{{$note->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@updateNoteContact',$note->id]]) !!}
                                                        <textarea type="text"
                                                                  class="form-control"
                                                                  placeholder="Type your note..."
                                                                  rows="4"
                                                                  name="notes"
                                                        >{{ $note->name }}</textarea>
                                                        @error('notes')
                                                        <p class="text-danger mt-2"> {{ $message }}</p>
                                                        @enderror

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
                                        {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminContactsController@deleteNoteContact',$note->id]]) !!}
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
                {{ $notes->links() }}
            </div>

            <p class="alert alert-dark fs-sm">
                <i class="fa fa-fw fa-info me-1"></i> These notes will not be displayed to the customer.
            </p>

            {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminContactsController@createNoteContact',$contact->id]]) !!}

            <div class="my-4">
                <textarea type="text"
                          class="form-control"
                          placeholder="Type your note..."
                          rows="4"
                          name="notes"
                ></textarea>
                @error('notes')
                <p class="text-danger mt-2"> {{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">Add Note</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <!-- END Private Notes -->
</div>
