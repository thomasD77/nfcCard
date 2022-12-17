<div>
    <div class="block block-rounded row">
        <div class="block-content block-content-full overflow-scroll">
            <div class="d-flex justify-content-between mb-1">
                <div class="d-flex">
                    <!-- Pagination Select-->
                    <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option selected value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                    </select>
                    <!-- End Pagination -->
                </div>
                <!-- Search Form (visible on larger screens) -->
                <div class="d-none d-md-inline-block col-6">
                    <input type="text" wire:model="filter" class="form-control form-control-alt" placeholder="Search for name or email..." id="page-header-search-input2">
                </div>
                <!-- END Search Form -->
                <div>
                    <label class="d-flex">
                        <input style="width: 62px" wire:model="datepicker_day"  class="form-control" type="number" max="31" min="1">
                        <input wire:model="datepicker" id="datepicker" type="month" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                        <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
                    </label>
                </div>
            </div>

            <div class="parent row">

                @include('admin.includes.flash')

                <div class="col-md-6">
                    <table class="table table-hover table-vcenter fs-sm">
                        <thead>
                        <tr>
                            <th scope="col">User ACC</th>
                            <th scope="col">Email</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Date</th>
                            <th scope="col">Profile</th>
                            <th scope="col">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-print me-2"></i>
                                    <input type="checkbox"
                                           @if(Auth()->user()->check_importer) checked @endif
                                           class="btn btn-sm btn-alt-secondary"
                                           wire:click="selectAll"  wire:loading.attr="disabled">
                                    <div wire:loading wire:target="selectAll">
                                        <i class="fa fa-sun fa-spin m-2"></i>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($urls)
                            @foreach($urls as $url)
                                @if(!isset($url->member->user->name))
                                    <tr class="bg-warning-light">
                                @elseif($url->is_admin_generated)
                                    <tr class="bg-info-light">
                                @else
                                    <tr class="bg-success-light">
                                @endif

                                        @if(isset($url->member->user))
                                            <td><a href="{{ route('users.edit', $url->member->user->id) }}">{{ $url->member->user->name }}</a></td>
                                        @else
                                            <td> [not-set] </td>
                                        @endif

                                        @if(isset($url->member->user))
                                            <td><a href="{{ route('users.edit', $url->member->user->id) }}">{{ $url->member->user->email }}</a></td>
                                        @else
                                            <td> [not-set] </td>
                                        @endif

                                        <td><span class="badge btn-dark p-2 w-100">{{$url->card_id ? 'Profile ' . $url->card_id : '[not-set]'}}</span></td>


                                        <td>{{$url->created_at ? $url->created_at->format('d-M-Y') : "*no reservation" }}</td>

                                        <td>
                                            @if($url->member)
                                            <div class="btn-group">
                                                <a href="{{route('profiles.edit', $url->member->id)}}">
                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit member">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                </a>

                                                @if($url->member->card_id !== 0)
                                                    <a href="{{route('direction', $url->member->card_id)}}" target="_blank">
                                                @else
                                                    <a href="{{route('direction.test', $$url->member)}}" target="_blank">
                                                        @endif

                                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show member">
                                                        <i class="far fa-eye"></i>
                                                    </button>
                                                    </a>
                                            </div>
                                            @endif
                                        </td>

                                        <td>
                                            <input type="checkbox"
                                                   @if(Auth()->user()->userToUrlImport()->where('listurl_id', $url->id)->exists())  checked @endif
                                                   class="btn btn-sm btn-alt-secondary"
                                                   wire:click="select({{$url->id}})">
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $urls->links()  !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
{{--                            <button wire:click="infoToggle" class="nav-link text-dark @if($info) active @endif">Info</button>--}}
                            <button wire:click="accounts" class="nav-link text-dark @if($accounts) active @endif">Accounts</button>
                            <button wire:click="profiles" class="nav-link text-dark @if($profiles) active @endif">Profiles</button>
                            <button wire:click="contacts" class="nav-link text-dark @if($contacts) active @endif">Contact</button>
                            <button wire:click="buttons" class="nav-link text-dark @if($buttons) active @endif">Buttons</button>
                            <button wire:click="message" class="nav-link text-dark @if($message) active @endif">Message</button>
                            <button wire:click="videos" class="nav-link text-dark @if($videos) active @endif">Videos</button>
                            <button wire:click="states" class="nav-link text-dark @if($states) active @endif">States</button>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
{{--                        @if($info)--}}
{{--                            <div class="tab-pane fade show active">--}}
{{--                                <h3 class="mt-2">General info</h3>--}}
{{--                                <p>--}}
{{--                                    With this data functionality you can import data for your company profile and members.--}}
{{--                                    The first step is always to select the accounts that you want to generate or update.--}}
{{--                                    Only select the records you want to edit, when you leave it blanco they will be--}}
{{--                                    overwritten.--}}
{{--                                </p>--}}
{{--                                <p>Thanks, <br> SWAP NFC</p>--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @if($accounts)
                            <div class="tab-pane fade show active">
                                @livewire('importer-accounts')
                            </div>
                        @endif

                        @if($profiles)
                            <div class="tab-pane fade show active">
                                @livewire('importer-profiles')
                            </div>
                        @endif

                        @if($contacts)
                            <div class="tab-pane fade show active">
                                @livewire('importer-contact')
                            </div>
                        @endif

                        @if($buttons)
                            <div class="tab-pane fade show active">
                                @livewire('importer-buttons')
                            </div>
                        @endif

                        @if($message)
                            <div class="tab-pane fade show active">
                                @livewire('importer-message')
                            </div>
                        @endif

                        @if($videos)
                            <div class="tab-pane fade show active">
                                @livewire('importer-videos')
                            </div>
                        @endif


                    @if($states)
                            <div class="tab-pane fade show active">
                                @livewire('importer-states')
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




