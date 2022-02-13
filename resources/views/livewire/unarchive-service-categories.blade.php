<div>
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
            @if($servicecategories)
                @foreach($servicecategories as $servicecategory)
                    <tr>
                        <td class="text-center">{{$servicecategory->id ? $servicecategory->id : 'No ID'}}</td>
                        <td>{{$servicecategory->name ? $servicecategory->name : 'No servicecategory'}}</td>
                        <td>{{$servicecategory->created_at->diffForHumans()}}</td>
                        <td>{{$servicecategory->updated_at->diffForHumans()}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-alt-secondary" wire:click="unArchiveServiceCategory({{$servicecategory->id}})"><i class="si si-refresh "></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
</div>
<div class="d-flex justify-content-center">
    {!! $servicecategories->links()  !!}
</div>






