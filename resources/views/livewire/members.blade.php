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
                <div class="d-none d-md-inline-block col-6">
                    <input type="text" wire:model="member_value" class="form-control form-control-alt" placeholder="Search for member credentials..." id="page-header-search-input2" name="member">
                </div>
                <!-- END Search Form -->
                <div>
                    <!-- Member list  -->
                    <a class="btn btn-alt-warning" role="button" href="{{ route('members.credentials') }}">
                        <i class="fa fa-print me-2"></i> Member List
                    </a>
                    <!-- END Member list -->
{{--                    @can('is_superAdmin')--}}
{{--                        <a href="{{ route('print') }}" class="btn btn-alt-success">--}}
{{--                            <i class="fa fa-print me-2"></i>--}}
{{--                        </a>--}}
{{--                    @endcan--}}
                </div>
            </div>
            <div class="parent">
                @include('admin.includes.flash')
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">avatar</th>
                        <th scope="col">name</th>
                        <th scope="col">Company</th>
                        <th scope="col"># Card ID</th>
                        <th scope="col">Material</th>
                        <th scope="col">user account</th>
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
                                <td>{{ $loop->index + 1  }}</td>
                                <td><img class="rounded-circle" height="62" width="62" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                <td>{{$member->lastname ? $member->lastname : ""}} {{ $member->firstname ? $member->firstname : '' }}</td>
                                <td>{{$member->company ? $member->company : ""}}</td>
                                <td>{{$member->card_id ? $member->card_id : 'No Card ID'}}</td>
                                <td>{{$member->material ? $member->material->name : 'No Material'}}</td>
                                <td>
                                    @if(isset($member->user))
                                        <a class="btn btn-outline-primary" href="{{ route('users.edit', $member->user->id) }}">
                                            {{$member->user ? $member->user->name : "unknown"}}
                                        </a>
                                    @else
                                        unknown
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('members.edit', $member->id)}}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>

                                        <a href="{{route('direction', $member->card_id)}}" target="_blank">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </a>

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


