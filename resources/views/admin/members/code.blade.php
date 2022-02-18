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

                        @if($QRcode->landingpaginaDefault == 1)
                        <th scope="col">Default URL</th>
                        @endif
                        @if($QRcode->landingpaginaCustom == 1)
                            <th scope="col">Custom URL</th>
                        @endif
                        @if($QRcode->vCard == 1)
                            <th scope="col">vCard URL</th>
                        @endif

                        <th scope="col">QR-code</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($members)
                        @foreach($members as $member)
                            <tr>
                                @if($QRcode->landingpaginaDefault == 1)
                                    <td>{{$member->memberURL ? $member->memberURL : 'No URL'}}</td>
                                @endif
                                    @if($QRcode->landingpaginaCustom == 1)
                                    <td>{{$member->memberCustomURL ? $member->memberCustomURL : 'No URL'}}</td>
                                @endif
                                    @if($QRcode->vCard == 1)
                                        <td>{{$member->membervCard ? $member->membervCard : 'No URL'}}</td>
                                @endif
                                {{--                                <td><img src="{{$member->memberQRcode ? $member->memberQRcode : 'No QRcode'}}" alt=""></td>--}}
                                <td><img src="http://nfccard.loc/admin/QRcode" alt=""></td>
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
