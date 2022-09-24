@if(Auth::user()->business)
<div>
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default row">

            <!-- Search Form (visible on larger screens) -->
            <form class="col-md-6">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search for contact..." id="page-header-search-input2" wire:model="name">
                </div>
            </form>
            <!-- END Search Form -->
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col" class="d-flex justify-content-end">
                            <div>
                                <!-- Pagination Select-->
                                <select wire:model="pagination" style="width: 80px" class="form-select mb-3 d-flex justify-content-end" aria-label="Default select example">
                                    <option value="5">5</option>
                                    <option value="20">20</option>
                                    <option selected value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <!-- End Pagination -->
                            </div>
                        </th>
                    </tr>
                </thead>
                    @if($contacts)
                        @foreach($contacts as $contact)
                            <tbody>
                                <tr>
                                    <td>
                                        <a class="text-dark" href="{{ route('contact.detail', $contact->id) }}">
                                            <strong>{{$contact->name ? $contact->name : 'Unknown'}}</strong>
                                        </a>
                                    </td>
                                    <td class="d-flex justify-content-end pe-md-3">
                                        <a href="{{ route('contact.detail', $contact->id) }}">
                                            <i class="far fa-address-book text-dark" style="font-size: 25px"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $contacts->links()  !!}
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@else
    <div class="alert alert-dark fs-sm">
        <div class="mt-2">
            <p class="mb-0"><i class="fa fa-fw fa-info me-1 mb-0"></i>
                To view this data you need a business account. <br>
                When this is active you can make add your connections in your contact list. You can add extra information to each contact to follow up easily.
            </p>
        </div>
    </div>
@endif


