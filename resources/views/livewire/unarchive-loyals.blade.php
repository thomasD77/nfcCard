<div>
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

        @if($loyals)
            @foreach($loyals as $loyal)
                <tr>
                    <td class="text-center">{{$loyal->id ? $loyal->id : 'No ID'}}</td>
                    <td>{{$loyal->name ? $loyal->name : 'No loyal'}}</td>
                    <td>{{$loyal->created_at->diffForHumans()}}</td>
                    <td>{{$loyal->updated_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Reset Loyal" wire:click="unArchiveLoyal({{$loyal->id}})"><i class="si si-refresh "></i></button>
                    </td>

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $loyals->links()  !!}
</div>






