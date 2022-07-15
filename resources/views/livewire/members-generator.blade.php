
<div class="block block-rounded row">
    <div class="block-content block-content-full overflow-scroll">
        <div class="d-flex justify-content-between mb-5">
            <!-- Pagination Select-->
            <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                <option value="5">5</option>
                <option value="20">20</option>
                <option selected value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <!-- End Pagination -->
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Generate new <i class="fa fa-star text-warning-light"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Generate your data here</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="col-8 mb-0" name="contactformulier"
                                      action="{{action('App\Http\Controllers\Dashboard\CardListGenerator@generateListUrl')}}" method="post">
                                    @csrf

                                    <div class="form-check my-4 px-0">
                                        <label class="form-check-label mb-1">How much cards do you need?</label>
                                        <input class="form-control" type="number" name="card_number" value="card_number">
                                    </div>

                                    <div class="form-check my-4 px-0">
                                        {!! Form::label('ambassador','Select company:', ['class'=>'form-label']) !!}
                                        {!! Form::select('ambassador',$ambassadors,null,['class'=>'form-control', 'placeholder' => 'Select here...'])!!}
                                    </div>

                                    <!-- Button trigger modal -->
                                    <button type="submit" class="btn btn-alt-primary my-4">
                                        <i class="fa fa-hourglass-start me-1 opacity-50"></i> GENERATE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="parent">
            @include('admin.includes.flash')

            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Company</th>

                    <th scope="col">(Active) card holders</th>

                    <th scope="col">Registered</th>

                    <th scope="col">Edit</th>

                </tr>
                </thead>
                <tbody>
                @if($teams)
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $loop->index + 1  }}</td>

                            <td>{{ $team->name }}</td>

                            <td><span class="badge badge-pill bg-success p-3">{{ $team->teamUsers->count() }}</span></td>

                            <td>{{ $team->created_at->format('Y-m-d') }}</td>

                            <td>
                                <a href="{{route('card-credentials-details', $team)}}">
                                    <button class="bt btn-sm btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="List Company">
                                        <i class="fa fa-clipboard-list"></i>
                                    </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $teams->links() }}
        </div>
    </div>
</div>



