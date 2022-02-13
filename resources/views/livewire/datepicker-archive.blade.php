<div>

    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                submissions
            </h3>
            <label class="d-flex">
                <a href="{{route('submissions.index')}}">
                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="List">
                        <i class="far fa-list-alt "></i>
                    </button>
                </a>
                <input wire:model="datepicker" id="datepicker" type="date" class="form-control" id="" name="" placeholder="Select date submission" data-inline="month" data-enable-time="false">
                <button wire:click="dateALL" class="btn btn-secondary rounded" data-bs-toggle="tooltip" title="Refresh" type="button"><i class="si si-refresh"></i></button>
            </label>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($submissions)
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{$submission->name ? $submission->name : 'No Name'}}</td>
                            <td>{{$submission->email ? $submission->email : 'No Email'}}</td>
                            <td>{{$submission->phone ? $submission->phone : 'No Phone'}}</td>
                            <td>{{$submission->created_at ? $submission->created_at : 'No Date'}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('submissions.show', $submission->id)}}"><button type="button" class="btn btn-sm btn-alt-secondary mx-1" data-bs-toggle="tooltip" title="Show Submission">
                                            <i class="fa far fa-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-alt-secondary" wire:click="unArchiveSub({{$submission->id}})"><i class="si si-refresh "></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $submissions->links()  !!}
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>

