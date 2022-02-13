<div class="parent">
    @include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($locations)
            @foreach($locations as $location)
                <tr>
                    <td>{{$location->id ? $location->id : 'No ID'}}</td>
                    <td>{{$location->name ? $location->name : 'No name'}}</td>
                    <td>{{$location->created_at ? $location->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('location.edit', $location->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit location">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveLocation({{$location->id}})"><i class="fa fa-archive"></i></button>
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

