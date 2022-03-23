<div>

    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                contacts
            </h3>
{{--            <a class="btn btn-dark me-3" href="{{route('contacts.export')}}">Export to Excel</a>--}}
            <label class="d-flex">
                <input wire:model="datepicker" id="datepicker" type="date" class="form-control" id="" name="" placeholder="Select date contact" data-inline="month" data-enable-time="false">
                <button wire:click="dateALL" class="btn btn-secondary rounded" type="button" data-bs-toggle="tooltip" title="Refresh"><i class="si si-refresh"></i></button>
{{--                <a href="{{route('contact.archive')}}">--}}
{{--                    <button class="btn btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="Archive">--}}
{{--                        <i class="fa fa-archive "></i>--}}
{{--                    </button>--}}
{{--                </a>--}}
            </label>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">phone</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($contacts)
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->name ? $contact->name : 'No Name'}}</td>
                            <td><a href="mailto:{{$contact->mail}}"> {{$contact->email ? $contact->email : 'No Email'}}</a></td>
                            <td>{{$contact->phone ? $contact->phone : 'No Phone'}}</td>
                            <td>{{$contact->created_at ? $contact->created_at->diffForhumans() : 'No Date'}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-alt-secondary" wire:click="archiveContact({{$contact->id}})"><i class="fa fa-archive "></i></button>
                                </div>
                            </td>
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
</div>
