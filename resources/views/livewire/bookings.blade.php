<div class="parent">
    @include('admin.includes.flash')
    <table class="table table-striped table-hover table-vcenter fs-sm">
        <thead>
        <tr>
            <th scope="col">Booking ID</th>
            @canany(['is_superAdmin', 'is_admin', 'is_employee'])
                <th scope="col">Booker</th>
                <th scope="col">Client</th>
            @endcanany
            <th scope="col">Service</th>
            <th scope="col">Date</th>
            <th scope="col">Shop</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
            @can('is_client')
            <th scope="col">Confirm</th>
            @endcan
        </tr>
        </thead>
        <tbody>
        @if($bookings)
                @foreach($bookings as $booking)
                    @if($booking->user->archived == 0)
                    <tr>
                        <td>
                            # {{$booking->id ? $booking->id : 'No ID'}}
                            @can('is_client')
                                @if($booking->booking_request_client == 1 && $booking->status->name == 'pending' && $booking->approved == 0 )
                                    <span class="badge badge rounded-pill bg-success text-white">NEW</span>
                                @endif
                            @endcan
                        </td>
                        @canany(['is_superAdmin', 'is_admin', 'is_employee'])
                            @php
                                $client = \App\Models\User::where('id', $booking->client_id)->first();
                            @endphp
                            <td>
                                {{ $booking->user->name }}
                            </td>
                            <td>
                                @if($booking->booking_request_admin == 1)
                                    <span class="badge badge rounded-pill bg-success text-white">NEW</span>
                                @endif
                                @if($booking->approved == 1)
                                    <span class="badge badge rounded-pill bg-default-light text-white">CONFIRMED</span>
                                @endif
                                {{$client ? $client->name : 'No name'}}
                            </td>
                        @endcanany
                        <td>@foreach($booking->services as $service)
                                <li>
                                    {{$service->name ? $service->name : 'No Service'}}
                                </li>
                            @endforeach</td>
                        <td>
                            {{$booking->date ? \Carbon\Carbon::parse($booking->date)->format('d-M-y') : 'No Date'}}
                            <div>
                                <span class="badge badge rounded-pill text-white bg-dark">{{ $booking->startTime ? \Carbon\Carbon::parse($booking->startTime)->format('h:i') : 'No Start Time' }}</span>
                                <span class="badge badge rounded-pill text-white bg-dark">{{ $booking->endTime ? \Carbon\Carbon::parse($booking->endTime)->format('h:i') : 'No End Time' }}</span>
                            </div>
                        </td>
                        <td>
                            {{ $booking->location->name }}
                        </td>
                        <td>
                            <span class="badge badge rounded-pill p-2 {{$booking->status->color}}">
                                {{$booking->status ? $booking->status->name : 'No Status'}}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group">
                                @canany(['is_superAdmin', 'is_admin', 'is_employee'])
                                <a href="{{route('bookings.edit', $booking->id)}}">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit booking">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                </a>
                                <button class="btn btn-sm btn-alt-secondary" wire:click="archiveBooking({{$booking->id}})"><i class="fa fa-archive"></i></button>
                                @endcanany
                                <a href="{{route('bookings.show', $booking->id)}}">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Show booking">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </a>
                                @can('is_client')
                                @if($booking->status->name == 'pending' && $booking->approved == 0)
                                        <a href="{{route('bookings.edit', $booking->id)}}">
                                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit booking">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                    @endif
                                @endcan
                            </div>
                        </td>
                        <td>
                            @can('is_client')
                            @if($booking->status->name == 'pending' && $booking->approved == 0 && $booking->booking_request_admin == 0)
                            {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminBookingController@approved'],'files'=>false])!!}
                            <div class="d-flex">
                                <div class="form-group mb-3">
                                    {!! Form::hidden('booking',$booking->id,['class'=>'form-control']) !!}
                                </div>
                                <button type="button" class="btn btn-sm btn-alt-success ms-3" data-bs-toggle="modal" data-bs-target="#modal-block-normal"><i class="far fa-thumbs-up"></i></button>
                                <!-- Normal Block Modal -->
                                <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-transparent mb-0">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Confirm Your Booking</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content fs-sm">
                                                    <p>Here you can Approve your booking.</p>
                                                    <p>Please know that after submitting this booking you can no longer change the status. </p>
                                                    <button class="btn btn-sm btn-alt-secondary mb-3 text-center" data-bs-toggle="tooltip" title="Approve booking" type="submit"><i class="far fa-thumbs-up"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Normal Block Modal -->
                            </div>
                            {!! Form::close() !!}
                            @elseif($booking->status->name == 'pending' && $booking->approved == 0 && $booking->booking_request_admin == 1)
{{--                                Nothing --}}
                                @else
{{--                                    <button type="button" data-bs-toggle="tooltip" title="This booking is confirmed" class="btn btn-sm btn-alt-success ms-3" ><i class="fa fa-check"></i></button>--}}
                                @endif
                            @endcan
                        </td>
                    </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {!! $bookings->links()  !!}
</div>

