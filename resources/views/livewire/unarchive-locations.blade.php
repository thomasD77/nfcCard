<div class="block-content block-content-full overflow-scroll parent">
@include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($locations)
            @foreach($locations as $location)
                <tr>
                    <td>{{$location->id ? $location->id : 'No ID'}}</td>
                    <td>{{$location->name ? $location->name : 'No Name'}}</td>
                    <td>{{$location->created_at ? $location->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-alt-secondary" wire:click="unArchiveLocation({{$location->id}})"><i class="si si-refresh "></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $locations->links()  !!}
</div>

