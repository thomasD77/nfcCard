
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
                        <button class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Reset Source" wire:click="unArchiveSource({{$source->id}})"><i class="si si-refresh "></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $sources->links()  !!}
</div>





