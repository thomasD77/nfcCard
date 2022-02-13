<div class="parent">
    @include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Registered</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($services)
            @foreach($services as $service)
                <tr>
                    <td>{{$service->id ? $service->id : 'No ID'}}</td>
                    <td>{{$service->name ? $service->name : 'No Name'}}</td>
                    <td>{{$service->servicecategory ? $service->servicecategory->name : 'No Category'}}</td>
                    <td>{{$service->created_at ? $service->created_at->diffForHumans() : 'Not Verified'}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('services.edit', $service->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit service">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                            </a>
                            <button class="btn btn-sm btn-alt-secondary" wire:click="archiveService({{$service->id}})"><i class="fa fa-archive"></i></button>
                            <a href="{{route('services.show', $service->id)}}">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show service">
                                    <i class="far fa-eye"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $services->links()  !!}
</div>
