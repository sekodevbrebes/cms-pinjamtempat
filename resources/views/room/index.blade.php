@extends('layouts.app')

@section('title', 'Data Tempat/Ruangan')

@section('contents')
    <div class="row">
        <!-- Base style - Hover table start -->
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header pb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-3 mb-sm-0">@yield('title')</h5>

                        <a href="{{ route('rooms.create') }}"
                            class="btn btn-primary d-inline-flex align-items-center gap-2"><i class="ti ti-plus f-18"></i>Add
                            Room</a>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive p-4">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th class="text-end">#</th>
                                    <th>Nama Tempat/Ruangan</th>
                                    <th>Capasitas</th>
                                    <th class="text-end">Rate</th>
                                    <th class="text-end">Category</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td class="text-end">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-auto pe-0">
                                                    <!-- Menampilkan satu gambar -->
                                                    @if ($room->image)
                                                        <?php $images = json_decode($room->image); ?>
                                                        @if (count($images) > 0)
                                                            <img src="{{ asset('storage/' . $images[0]) }}" alt="Room Image"
                                                                class="wid-100 rounded" height="100">
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <h6 class="mb-1">
                                                        {{ $room->name }}
                                                    </h6>
                                                    <p class="text-muted f-12 mb-0">
                                                        {{ $room->location }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $room->capacity }}</td>

                                        <td class="text-end">{{ $room->rate }}</td>


                                        <td class="text-end">{{ $room->type }}</td>

                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    title="View">
                                                    <a href="{{ route('rooms.show', $room->id) }}"
                                                        class="avtar avtar-xs btn-link-secondary btn-pc-default"><i
                                                            class="ti ti-eye f-18"></i></a>
                                                </li>
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <a href="{{ route('rooms.edit', $room->id) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                            class="ti ti-edit-circle f-18"></i></a>
                                                </li>

                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    title="Delete">

                                                    <a href="{{ route('rooms.destroy', $room->id) }}"
                                                        class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                        data-confirm-delete="true"><i class="ti ti-trash f-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- 
                                <tr>
                                    <td class="text-end">2</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto pe-0">
                                                <img src="../assets/images/application/img-prod-2.jpg" alt="user-image"
                                                    class="wid-40 rounded" />
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-1">Boat On-Ear Wireless</h6>
                                                <p class="text-muted f-12 mb-0">
                                                    Mic(Bluetooth 4.2, Rockerz 450R
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Electronics, Headphones</td>
                                    <td class="text-end">$81.99</td>
                                    <td class="text-end">45</td>
                                    <td>
                                        <span class="badge bg-light-danger f-12">Out of Stock</span>
                                    </td>
                                    <td class="text-center">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="View">
                                                <a href="#" class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                    data-bs-toggle="modal" data-bs-target="#cust-modal"><i
                                                        class="ti ti-eye f-18"></i></a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <a href="ecom_product-add.html"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default"><i
                                                        class="ti ti-edit-circle f-18"></i></a>
                                            </li>
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="Delete">
                                                <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default"><i
                                                        class="ti ti-trash f-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Base style - Hover table end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection
