@canany(['is_superAdmin', 'is_admin'])
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
                <!-- Search Form (visible on larger screens) -->
                <form class="d-none d-md-inline-block col-6" action="{{action('App\Http\Controllers\AdminMembersController@searchMember')}}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="member">
                        <span class="input-group-text border-0"><button class="border border-0" type="submit"><i class="fa fa-fw fa-search"></i></button></span>
                    </div>
                </form>
                <!-- END Search Form -->
                <div>
                    <!-- Member list  -->
                    <a class="btn btn-alt-warning" role="button" href="{{ route('members.credentials') }}">
                        <i class="fa fa-print me-2"></i> Member List
                    </a>
                    <!-- END Member list -->
                    @can('is_superAdmin')
                        <a href="{{ route('print') }}" class="btn btn-alt-success">
                            <i class="fa fa-print me-2"></i>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="parent">
                @include('admin.includes.flash')
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col"># Card ID</th>
                        <th scope="col">avatar</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">Package</th>
                        <th scope="col">Material</th>
                        <th scope="col">Actions</th>
                        @can('is_superAdmin')
                            <th scope="col"> <i class="fa fa-print me-2"></i></th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @if($members)
                        @foreach($members as $member)
                            <tr>
                                <td>{{$member->card_id ? $member->card_id : 'No Card ID'}}</td>
                                <td><img class="rounded-circle" height="62" width="62" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                <td>{{$member->lastname ? $member->lastname : ""}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                <td>{{$member->email ? $member->email : "unknown"}}</td>
                                <td>{{$member->package ? $member->package->package : 'No Package'}}</td>
                                <td>{{$member->material ? $member->material->name : 'No Material'}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('members.edit', $member->id)}}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        @can('is_superAdmin')
                                        <a href="{{route('direction', $member->card_id)}}" target="_blank">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                                @can('is_superAdmin')
                                        <td>
                                            <input type="checkbox"
                                                   @if($member->print == 1)  checked @endif
                                                   class="btn btn-sm btn-alt-secondary"
                                                   wire:click="select({{$member->id}})">
                                        </td>
                                @endcan
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $members->links()  !!}
            </div>
        </div>
    </div>
@endcanany

@can('is_client')
    <div class="block block-rounded row">
        <div class="block-content block-content-full overflow-scroll">

            @if($member->user->archived == 0)

            <div class="parent">
                @include('admin.includes.flash')
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">avatar</th>
                        <th scope="col">name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($member)
                        <tr>
                            <td><img class="rounded-circle" height="62" width="62" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                            <td>{{$member->lastname ? $member->lastname : ""}} {{ $member->firstname ? $member->firstname : '' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('members.edit', $member->id)}}">
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                    </a>
{{--                                    <a href="{{route('direction', $member->card_id)}}" target="_blank">--}}
{{--                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">--}}
{{--                                            <i class="far fa-eye"></i>--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            @else

                <p class="p-2">Sorry, the admin blocked your account. Please contact him for this situation.</p>

            @endif


            <div class="d-flex justify-content-center">
                {!! $members->links()  !!}
            </div>
        </div>
    </div>
@endcan
