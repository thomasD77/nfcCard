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
                    <input type="text" wire:model="filter" class="form-control form-control-alt" placeholder="Search for webshop id/user/reservation..." id="page-header-search-input2">
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
                            <th scope="col">Card ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Profile</th>
                            <th scope="col"> <i class="fa fa-print me-2"></i>
                                <input type="checkbox"
                                       @if($checkbox_active) checked @endif
                                       class="btn btn-sm btn-alt-secondary"
                                       wire:click="selectAll">
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

                                        <td>{{$url->card_id ? $url->card_id : 'No ID'}}</td>

                                        <td>{{$url->card_id ? $url->card_id : 'No ID'}}</td>

                                        <td>{{$url->created_at ? $url->created_at->format('d-M-Y') : "*no reservation" }}</td>

                                        <td>
                                            @if($url->member)
                                            <div class="btn-group">
                                                <a href="{{route('members.edit', $url->member->id)}}">
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
                                                   @if($url->check_import)  checked @endif
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
                    <h5 class="pt-3">Select the empty accounts that you want to create/generate.</h5>
                    <form class="js-validation-signup" wire:submit.prevent="generateAccounts">
                        @csrf
                        <div class="py-3">

                            <div class="mb-4">
                                <input placeholder="email"
                                       id="email"
                                       type="email"
                                       required
                                       class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror"
                                       wire:model="email"
                                       >
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-9 col-md-10 pe-0">
                                        <input placeholder="password"
                                               id="password"
                                               type="password"
                                               class="form-control form-control-lg form-control-alt @error('password') is-invalid @enderror"
                                               wire:model="password"
                                               required
                                               >
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <button type="button"
                                                class="form-control text-center"
                                                style="height: 100%"
                                                onclick="myFunction()">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <p class="text-muted mb-1">Password rules:</p>
                                <ul>
                                    <li class="text-muted"> At least one capital letter </li>
                                    <li class="text-muted"> At least one letter</li>
                                    <li class="text-muted"> At least one digit</li>
                                    <li class="text-muted"> At least one symbol</li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <input placeholder="confirm password"
                                       id="password-confirm"
                                       type="password"
                                       required
                                       class="form-control form-control-lg form-control-alt"
                                       wire:model="password_confirmation"
                                       >
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Generate accounts
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




