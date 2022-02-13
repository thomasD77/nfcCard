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
        @if($postcategories)
            @foreach($postcategories as $postcategory)
                <tr>
                    <td class="text-center">{{$postcategory->id ? $postcategory->id : 'No ID'}}</td>
                    <td>{{$postcategory->name ? $postcategory->name : 'No postcategory'}}</td>
                    <td>{{$postcategory->created_at->diffForHumans()}}</td>
                    <td>{{$postcategory->updated_at->diffForHumans()}}</td>
                    <td>
                        <button class="btn btn-sm btn-alt-secondary" wire:click="unArchivePostCategory({{$postcategory->id}})"><i class="si si-refresh "></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $postcategories->links()  !!}
</div>




