<!-- Page Content -->
<div class="content container-fluid">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded row">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Members
            </h3>
        </div>
        <div class="block-content block-content-full overflow-scroll">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div>
                <table class="table table-striped table-hover table-vcenter fs-sm">
                    <thead>
                    <tr>
                        @if($QRcode == 'default')
                        <th scope="col">Default URL (this url needs to be programmed in the NFC Card)</th>
                        @endif
                        @if($QRcode == 'custom')
                            <th scope="col">Custom URL (this url needs to be programmed in the NFC Card)</th>
                        @endif
                        @if($QRcode == 'vCard')
                            <th scope="col">vCard URL (this url needs to be PROGRAMMED IN the NFC Card)</th>
                        @endif

                        <th scope="col">QR-code (this QRcode needs to be PRINTED ON the backside OF NFC Card)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($members)
                        @foreach($members as $member)
                            <tr>
                                @if($QRcode == 'default')
                                    <td>{{$member->memberURL ? $member->memberURL : 'No URL'}}</td>
                                @endif
                                @if($QRcode == 'custom')
                                    <td>{{$member->memberCustomURL ? $member->memberCustomURL : 'No URL'}}</td>
                                @endif
                                @if($QRcode == 'vCard')
                                        <td>{{$member->membervCard ? $member->membervCard : 'No URL'}}</td>
                                @endif
                                <td><img src="{{ $member->memberQRcode }}" alt="QRcode"></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
