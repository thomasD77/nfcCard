<!-- Page Content -->
<div class="content">
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-6">
            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-dark">
                        <i class="fa fa-pencil-alt"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-muted mb-0">
                        Edit Contact
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-danger">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-danger mb-0">
                        Remove Contact
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- END Quick Actions -->

    <!-- User Info -->
    <div class="block block-rounded">
        <div class="block-content text-center">
            <div class="py-4">
                <div class="mb-3">
                    <td><img class="rounded-circle" height="150" width="150" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                </div>
                <h1 class="fs-lg mb-0">
                    <span>{{ $contact->name }}</span>
                </h1>
                @if($member)
                <p class="fs-sm fw-medium text-muted">{{ $member->jobTitle }}</p>
                @endif
            </div>
        </div>
        <div class="block-content bg-body-light text-center">
            <div class="row items-push text-uppercase">
                <div class="col-6 col-md-3">
                    <div class="fw-semibold text-dark mb-1">SWAP DATE</div>
                    <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $contact->created_at->format('d-M-Y') }}</a>
                </div>
                @if($contact->sector)
                <div class="col-6 col-md-3">
                    <div class="fw-semibold text-dark mb-1">Sector</div>
                    <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $contact->sector ? $contact->sector->name : "" }}</a>
                </div>
                @endif
                <div class="col-6 col-md-3">
                    <div class="fw-semibold text-dark mb-1">Notes</div>
                    <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $notes ? $notes->count() : 0 }}</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fw-semibold text-dark mb-1">Events</div>
                    <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $contact->events ? $contact->events->count() : 0 }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Addresses -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Addresses</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-6 pb-4">
                    <!-- Contact information -->
                    <div class="block block-rounded block-bordered" style="height: 100%">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Contact information</h3>
                        </div>
                        <div class="block-content">
                            <div class="fs-4 mb-1">{{ $contact->name }}</div>
                            <address class="fs-sm">

                                @if($contact->phone)
                                    <i class="fa fa-phone mb-2"></i> {{ $contact->phone }}<br>
                                @endif
                                @if($contact->email)
                                    <i class="far fa-envelope mb-2"></i> <a href="mailto:{{$contact->email}}">{{ $contact->email }}</a><br>
                                @endif
                                @if($contact->company)
                                    <i class="fa fa-building mb-2"></i> {{ $contact->company }}<br>
                                @endif
                                @if($contact->VAT)
                                    <i class="far fa-bookmark mb-2"></i> {{ $contact->VAT }}<br>
                                @endif
                            </address>
                        </div>
                    </div>
                    <!-- END Contact information -->
                </div>
                <div class="col-lg-6 pb-4">
                    @if($member)
                        <!-- Member-->
                        <div class="block block-rounded block-bordered" style="height: 100%">
                            <div class="block-header border-bottom">
                                <div class="row w-100">
                                    <div class="col-10">
                                        <h3 class="block-title">SWAP Account</h3>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <a class="btn btn-sm btn-alt-secondary" target="_blank" href="{{ $member->memberURL }}" data-bs-toggle="tooltip" title="Profile">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="fs-4 mb-1">{{ $member->firstname }} {{ $member->lastname }}</div>
                                <address class="fs-sm">
                                    @if($member->mobile)
                                        <i class="fa fa-phone mb-2"></i>{{ $member->mobile }}<br>
                                    @endif
                                    @if($member->mobileWork)
                                        <i class="fa fa-phone mb-2"></i>{{ $member->mobileWork }}<br>
                                    @endif
                                    <i class="far fa-envelope mb-2"></i> <a href="mailto:{{$member->email}}">{{ $member->email }}</a><br>

                                    {{ $member->addressLine1 }}<br>
                                    {{ $member->city }}, {{ $member->postalCode }}<br>
                                    {{ $member->country }}<br><br>

                                </address>
                            </div>
                        </div>
                        <!-- END Member -->
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END Addresses -->

    @if($contact->message)
        <!-- Message -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Message</h3>
            </div>
            <div class="block-content p-2 p-lg-4">
                {{ $contact->message }}
            </div>
        </div>
        <!-- END Message -->
    @endif

    <!-- Past Orders -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Past Orders (5)</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">ID</th>
                        <th class="d-none d-md-table-cell text-center">Products</th>
                        <th class="d-none d-sm-table-cell text-center">Submitted</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell text-end">Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                <strong>ORD.0625</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell text-center fs-sm">
                            <a href="javascript:void(0)">5</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">08/03/2019</td>
                        <td>
                            <span class="badge bg-success">Delivered</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$47,00</strong>
                        </td>
                        <td class="text-center fs-sm">
                            <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                <strong>ORD.0624</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell text-center fs-sm">
                            <a href="javascript:void(0)">4</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">22/09/2019</td>
                        <td>
                            <span class="badge bg-success">Delivered</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$122,00</strong>
                        </td>
                        <td class="text-center fs-sm">
                            <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                <strong>ORD.0623</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell text-center fs-sm">
                            <a href="javascript:void(0)">8</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">14/02/2019</td>
                        <td>
                            <span class="badge bg-success">Delivered</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$294,00</strong>
                        </td>
                        <td class="text-center fs-sm">
                            <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                <strong>ORD.0622</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell text-center fs-sm">
                            <a href="javascript:void(0)">5</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">03/12/2019</td>
                        <td>
                            <span class="badge bg-success">Delivered</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$108,00</strong>
                        </td>
                        <td class="text-center fs-sm">
                            <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_order.html">
                                <strong>ORD.0621</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell text-center fs-sm">
                            <a href="javascript:void(0)">5</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">10/10/2019</td>
                        <td>
                            <span class="badge bg-success">Delivered</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$173,00</strong>
                        </td>
                        <td class="text-center fs-sm">
                            <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Past Orders -->


    @if(!$referred_members->isEmpty())
        <!-- Referred Members -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Referred Members</h3>
            </div>
            <div class="block-content">
                <div class="row items-push">
                    @foreach($referred_members as $member)
                        <div class="col-md-4">
                            <!-- Referred User -->
                            <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0" href="{{ $member->memberURL }}" target="_blank">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fw-semibold mb-1">{{ $member->firstname }} {{ $member->lastname }}</div>
                                        <div class="fs-sm text-muted">{{ $member->jobTitle }}</div>
                                    </div>
                                    <div class="ms-3">
                                        <td><img class="rounded-circle" height="80" width="80" src="{{$member->avatar ? asset('/card/avatars') . "/" . $member->avatar : asset('/assets/front/img/Avatar-4.svg') }}" alt="{{$member->name}}"></td>
                                    </div>
                                </div>
                            </a>
                            <!-- END Referred User -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END Referred Members -->
    @endif

    <!-- Private Notes -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Private Notes</h3>
        </div>
        <div class="block-content">
            <p class="alert alert-dark fs-sm">
                <i class="fa fa-fw fa-info me-1"></i> These notes will not be displayed to the customer.
            </p>

            @if($notes)
                @foreach($notes as $note)
                    <div class="row">
                        <div class="col-9 col-lg-10 py-2 mt-4">
                            {{ $note->name }}
                        </div>
                        <div class="col-lg-1 d-none d-lg-block text-center py-2 mt-4">
                            {{ $note->created_at }}
                        </div>
                        <div class="col-3 col-lg-1 d-flex justify-content-end py-2 mt-4">
                            <div>
                                <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html" data-bs-toggle="tooltip" title="View">
                                    <i class="si si-pencil"></i>
                                </a>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            <form action="be_pages_ecom_customer.html" class="mt-5" onsubmit="return false;">
                <div class="mb-4">
                    <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4" placeholder="Maybe a special request?"></textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-alt-primary">Add Note</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Private Notes -->
</div>
<!-- END Page Content -->
