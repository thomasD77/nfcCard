@if(Auth::user()->business)
<div>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-header block-header-default row px-0 py-3 px-md-3" style="background-color: transparent">
            <button class="btn btn-primary" style="background-color: #1F2A37; border: 1px solid #1F2A37" wire:ignore.self type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-filter me-2"></i> Click for search/filter options
            </button>
            <div class="collapse" id="collapseExample" wire:ignore.self>
                <div class="row card-body px-0">
                    <!-- Search Form  -->
                    <form class="col-md-6 px-0 py-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-alt" placeholder="Search for name..." id="page-header-search-input2" wire:model="name">
                        </div>
                    </form>
                    <!-- END Search Form -->

                    <!-- Datepicker  -->
                    <div class="col-md-5 offset-md-1 my-4 my-md-0 px-0">
                        <label class="d-flex py-2">
                            <label class="d-flex align-items-center text-muted d-none d-md-block pt-2" style="font-size: 10px">DAY</label>
                            <input style="width: 65px" wire:model="datepicker_day"  class="form-control" type="number" max="31" min="1">
                            <label class="d-flex align-items-center text-muted ms-1 d-none d-md-block pt-2" style="font-size: 10px">MONTH/YEAR</label>
                            <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                            <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                        </label>
                    </div>
                    <!-- Datepicker  -->

                    <div class="d-flex justify-content-start justify-content-md-end px-0">

                        <a href="{{route('contact.archive-clients', Auth()->user() )}}">
                            <button class="btn btn-secondary rounded me-2" data-bs-toggle="tooltip" title="Archive">
                                <i class="fa fa-archive "></i>
                            </button>
                        </a>

{{--                        <a href="{{ route('print.scans.client') }}" class="btn btn-alt-success me-2">--}}
{{--                            <i class="fa fa-file-export mx-1"></i>--}}
{{--                        </a>--}}

                        <!-- Pagination Select-->
                        <div class="d-flex justify-content-md-end">
                            <select wire:model="pagination" style="width: 80px" class="form-select " aria-label="Default select example">
                                <option value="5">5</option>
                                <option value="20">20</option>
                                <option selected value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <!-- End Pagination -->
                </div>
            </div>

            </div>
        </div>

        <div class="block-content block-content-full overflow-scroll px-1">
            <!-- Session flash-->
            @if(Session::has('contact_message'))
                <p class="alert alert-info my-3">{{session('contact_message')}}</p>
            @endif
            @if(Session::has('contact_message_success'))
                <p class="alert alert-success my-3">{{session('contact_message_success')}}</p>
        @endif
            <!-- End Session flash -->

            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
{{--                    <th scope="col"> <i class="fa fa-file-export me-2"></i>--}}
{{--                        <input type="checkbox"--}}
{{--                               @if($user->member->check_all_print_client) checked @endif--}}
{{--                               class="btn btn-sm btn-alt-secondary"--}}
{{--                               wire:click="selectAll">--}}
{{--                    </th>--}}
                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                <a style="color: black" href="{{ route('contact.detail', $contact->id) }}">{{$contact->name ? $contact->name : 'No Name'}}</a>
                            </td>

                            <td><a style="{{$contact->email ? '' : 'color:black'}}" href="mailto:{{$contact->email ? $contact->email : '#'}}"> {{$contact->email ? $contact->email : 'x'}}</a></td>

                            <td><a style="{{$contact->phone ? '' : 'color:black'}}" href="tel:{{$contact->phone ? $contact->phone : '#'}}">{{$contact->phone ? $contact->phone : 'x'}}</a></td>

                            <td>
                                @if($contact->contactStatus)

                                    <span class="badge badge-pill w-100

                                            @if($contact->contactStatus->id == 1) bg-dark
                                            @elseif($contact->contactStatus->id == 2) bg-amethyst-lighter
                                            @elseif($contact->contactStatus->id == 3) bg-amethyst-light
                                            @elseif($contact->contactStatus->id == 4) bg-warning-light
                                            @elseif($contact->contactStatus->id == 5) bg-success
                                            @endif p-2">
                                            {{ $contact->contactStatus->name }}
                                    </span>

                                @else

                                    no status

                                @endif
                            </td>
                            <td>{{$contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('d-M-Y') : 'x'}}</td>                                <td>
                                <div class="btn-group">
                                    <a href="{{ route('contact.detail', $contact->id) }}" class="btn btn-sm btn-alt-secondary"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
{{--                            <td>--}}
{{--                                <input type="checkbox"--}}
{{--                                       @if($contact->print)  checked @endif--}}
{{--                                       class="btn btn-sm btn-alt-secondary"--}}
{{--                                       wire:click="select({{$contact}})">--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>

        <div class="d-flex justify-content-center">
            {!! $contacts->links()  !!}
        </div>
    </div>
    <!-- END Dynamic Table Full -->
    @else
        <div class="alert alert-dark fs-sm">
            <div class="mt-2">
                <p class="mb-0"><i class="fa fa-fw fa-info me-1 mb-0"></i>
                    To view this data you need a business account. <br>
                    When this is active you can make connections with your profile that you exchange. All data will be displayed here with a filter to search and find easily.
                </p>
            </div>
        </div>
    @endif
</div>


