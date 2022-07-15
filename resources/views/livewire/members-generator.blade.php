
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
            <div>

            </div>
        </div>
        <div class="parent">
            @include('admin.includes.flash')

            <table class="table table-striped table-hover table-vcenter fs-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">Company</th>

                    <th scope="col">(Active) card holders</th>

                    <th scope="col">Registered</th>

                    <th scope="col">Edit</th>

                </tr>
                </thead>
                <tbody>
                @if($teams)
                    @foreach($teams as $team)
                        <tr>
                            <td>{{ $loop->index + 1  }}</td>

                            <td>{{ $team->name }}</td>

                            <td><span class="badge badge-pill bg-success p-3">{{ $team->teamUsers->count() }}</span></td>

                            <td>{{ $team->created_at->format('Y-m-d') }}</td>

                            <td>
                                <a href="{{route('card-credentials-details', $team)}}">
                                    <button class="bt btn-sm btn-secondary rounded mx-2" data-bs-toggle="tooltip" title="List Company">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $teams->links() }}
        </div>
    </div>
</div>



