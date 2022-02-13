<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Sources
        </h3>
        <a href="{{route('sources.archive')}}">
            @canany(['is_superAdmin', 'is_admin'])
                <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">
                    <i class="fa fa-archive "></i>
                </button>
            @endcanany
        </a>
    </div>
    <div class="block-content block-content-full overflow-scroll">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-striped table-hover table-vcenter  fs-sm">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="d-none d-sm-table-cell" >Name</th>
                <th class="d-none d-sm-table-cell" >Created</th>
                <th class="d-none d-sm-table-cell" >Updated</th>
                <th class="d-none d-sm-table-cell text-center" >Actions</th>
            </tr>
            </thead>
            <tbody>

            @if($sources)
                @foreach($sources as $source)
                    <tr>
                        <td class="text-center">{{$source->id ? $source->id : 'No ID'}}</td>
                        <td>{{$source->name ? $source->name : 'No source'}}</td>
                        <td>{{$source->created_at->diffForHumans()}}</td>
                        <td>{{$source->updated_at->diffForHumans()}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$source->id}}">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Archive Source" wire:click="archiveSource({{$source->id}})"><i class="fa fa-archive"></i></button>
                            </div>
                        </td>
                        <div wire:ignore.self class="modal fade" id="exampleModal{{$source->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h5 class="modal-title d-flex align-items-center text-dark" id="exampleModalLabel">Edit source</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="submitFormSource({{$source->id}})">
                                            <div class="modal-body">
                                                <div  class="row">
                                                    <div class="col-12">

                                                        <input id="input1"
                                                               type="text"
                                                               class="form-control my-1 styleinput"
                                                               aria-label="Username"
                                                               aria-describedby="basic-addon1"
                                                               wire:model="source_name"
                                                               placeholder="{{$source->name}}"
                                                        >
                                                        @error('name')
                                                        <p class="text-danger"> {{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dark">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            window.addEventListener('closeModal', event => {
                                $("#exampleModal{{$source->id}}").modal('hide');
                            })
                        </script>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $sources->links()  !!}
        </div>
    </div>
</div>




