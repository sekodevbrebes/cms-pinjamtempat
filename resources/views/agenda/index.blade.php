@extends('layouts.app')

@section('title', 'Data Pinjam Tempat/Ruang')

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs invoice-tab border-bottom mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="analytics-tab-1" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                                aria-controls="analytics-tab-1-pane" aria-selected="true">
                                <span class="d-flex align-items-center gap-2">All
                                    <span class="avtar rounded-circle bg-light-primary">{{ $totalCount }}</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-2" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                                aria-controls="analytics-tab-2-pane" aria-selected="false">
                                <span class="d-flex align-items-center gap-2">Pending
                                    <span class="avtar rounded-circle bg-light-success">{{ $pendingCount }}</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-3" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-3-pane" type="button" role="tab"
                                aria-controls="analytics-tab-3-pane" aria-selected="false">
                                <span class="d-flex align-items-center gap-2">In Progress
                                    <span
                                        class="avtar rounded-circle bg-light-warning">{{ $approvedFutureCount }}</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-4" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-4-pane" type="button" role="tab"
                                aria-controls="analytics-tab-4-pane" aria-selected="false">
                                <span class="d-flex align-items-center gap-2">Cancelled
                                    <span class="avtar rounded-circle bg-light-danger">{{ $cancelledCount }}</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-6" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-6-pane" type="button" role="tab"
                                aria-controls="analytics-tab-6-pane" aria-selected="false">
                                <span class="d-flex align-items-center gap-2">Decline
                                    <span class="avtar rounded-circle bg-light-info">{{ $declineCount }}</span></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-5" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-5-pane" type="button" role="tab"
                                aria-controls="analytics-tab-5-pane" aria-selected="false">
                                <span class="d-flex align-items-center gap-2">Finish
                                    <span
                                        class="avtar rounded-circle bg-light-secondary">{{ $approvedPastCount }}</span></span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="analytics-tab-1-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-1" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Room</th>
                                            <th>Date</th>
                                            <th class="text-center">Time</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agenda as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="row align-items-center">
                                                        <div class="col-auto pe-0">
                                                            @if ($item->user->image)
                                                                <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                    alt="{{ $item->image }}" height="40"
                                                                    class="wid-40 rounded-circle" />
                                                            @else
                                                                <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                    alt="Photo Profile" class="wid-40 rounded-circle" />
                                                            @endif
                                                        </div>
                                                        <div class="col">
                                                            <h6 class="mb-1">
                                                                <span
                                                                    class="text-truncate w-100">{{ $item->user->name }}</span>
                                                            </h6>
                                                            <p class="f-12 mb-0">
                                                                <a href="#!" class="text-muted"><span
                                                                        class="text-truncate w-100"><span
                                                                            class="__cf_email__"
                                                                            data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                            {{ $item->user->instansi }}</span></span></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->room->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = '';
                                                        switch ($item->status) {
                                                            case 'Cancelled':
                                                                $statusClass = 'bg-light-danger';
                                                                break;
                                                            case 'Accept':
                                                                $statusClass = 'bg-light-primary';
                                                                break;
                                                            case 'Pending':
                                                                $statusClass = 'bg-light-warning';
                                                                break;
                                                            default:
                                                                $statusClass = 'bg-light-secondary'; // default class jika status tidak dikenali
                                                                break;
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">{{ $item->status }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            title="View">
                                                            <a href="{{ route('agenda.show', $item->id) }}"
                                                                class="avtar avtar-s btn-link-info btn-pc-default"><i
                                                                    class="ti ti-eye f-20"></i></a>
                                                        </li>

                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            title="Delete">

                                                            <a href="{{ route('agenda.destroy', $item->id) }}"
                                                                class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                                data-confirm-delete="true"><i
                                                                    class="ti ti-trash f-18"></i></a>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-2" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-2">
                                    <thead>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Room</th>
                                        <th>Create Date</th>
                                        <th class="text-center">Time</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1; // Inisialisasi counter untuk nomor urut
                                        @endphp
                                        @foreach ($agenda as $item)
                                            @if ($item->status === 'Pending')
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto pe-0">
                                                                @if ($item->user->image)
                                                                    <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                        alt="{{ $item->image }}" height="40"
                                                                        class="wid-40 rounded-circle" />
                                                                @else
                                                                    <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                        alt="Photo Profile"
                                                                        class="wid-40 rounded-circle" />
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="mb-1">
                                                                    <span
                                                                        class="text-truncate w-100">{{ $item->user->name }}</span>
                                                                </h6>
                                                                <p class="f-12 mb-0">
                                                                    <a href="#!" class="text-muted"><span
                                                                            class="text-truncate w-100"><span
                                                                                class="__cf_email__"
                                                                                data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                                {{ $item->user->instansi }}</span></span></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->room->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                    <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                    <td>
                                                        <span class="badge bg-light-warning">{{ $item->status }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="View">
                                                                <a href="{{ route('agenda.show', $item->id) }}"
                                                                    class="avtar avtar-s btn-link-info btn-pc-default"><i
                                                                        class="ti ti-eye f-20"></i></a>
                                                            </li>
                                                            {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="Edit">
                                                                <a href="#"
                                                                    class="avtar avtar-s btn-link-success btn-pc-default"><i
                                                                        class="ti ti-edit f-20"></i></a>
                                                            </li> --}}
                                                            <li class="list-inline-item align-bottom"
                                                                data-bs-toggle="tooltip" title="Delete">

                                                                <a href="{{ route('agenda.destroy', $item->id) }}"
                                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                                    data-confirm-delete="true"><i
                                                                        class="ti ti-trash f-18"></i></a>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                @php
                                                    $counter++; // Increment counter setelah satu data ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-3-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-3" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Room</th>
                                            <th>Date</th>
                                            <th class="text-center">Time</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1; // Inisialisasi counter untuk nomor urut
                                        @endphp
                                        @foreach ($dataFuture as $item)
                                            @if ($item->status === 'Accept')
                                                <tr>
                                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto pe-0">
                                                                @if ($item->user->image)
                                                                    <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                        alt="{{ $item->image }}" height="40"
                                                                        class="wid-40 rounded-circle" />
                                                                @else
                                                                    <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                        alt="Photo Profile"
                                                                        class="wid-40 rounded-circle" />
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="mb-1">
                                                                    <span
                                                                        class="text-truncate w-100">{{ $item->user->name }}</span>
                                                                </h6>
                                                                <p class="f-12 mb-0">
                                                                    <a href="#!" class="text-muted"><span
                                                                            class="text-truncate w-100"><span
                                                                                class="__cf_email__"
                                                                                data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                                {{ $item->user->instansi }}</span></span></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->room->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                    <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                    <td>
                                                        <span class="badge bg-light-primary">{{ $item->status }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="View">
                                                                <a href="{{ route('agenda.show', $item->id) }}"
                                                                    class="avtar avtar-s btn-link-info btn-pc-default"><i
                                                                        class="ti ti-eye f-20"></i></a>
                                                            </li>
                                                            {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="Edit">
                                                                <a href="#"
                                                                    class="avtar avtar-s btn-link-success btn-pc-default"><i
                                                                        class="ti ti-edit f-20"></i></a>
                                                            </li> --}}
                                                            <li class="list-inline-item align-bottom"
                                                                data-bs-toggle="tooltip" title="Delete">

                                                                <a href="{{ route('agenda.destroy', $item->id) }}"
                                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                                    data-confirm-delete="true"><i
                                                                        class="ti ti-trash f-18"></i></a>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                @php
                                                    $counter++; // Increment counter setelah satu data ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-4-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-4" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-4">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Room</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1; // Inisialisasi counter untuk nomor urut
                                        @endphp
                                        @foreach ($agenda as $item)
                                            @if ($item->status === 'Cancelled')
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto pe-0">
                                                                @if ($item->user->image)
                                                                    <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                        alt="{{ $item->image }}" height="40"
                                                                        class="wid-40 rounded-circle" />
                                                                @else
                                                                    <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                        alt="Photo Profile"
                                                                        class="wid-40 rounded-circle" />
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="mb-1">
                                                                    <span
                                                                        class="text-truncate w-100">{{ $item->user->name }}</span>
                                                                </h6>
                                                                <p class="f-12 mb-0">
                                                                    <a href="#!" class="text-muted"><span
                                                                            class="text-truncate w-100"><span
                                                                                class="__cf_email__"
                                                                                data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                                {{ $item->user->instansi }}</span></span></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->room->name }}</td>
                                                    {{-- <td>{{ $item->tanggal }}</td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                    </td>
                                                    <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                    <td>
                                                        <span class="badge bg-light-danger">{{ $item->status }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="View">
                                                                <a href="{{ route('agenda.show', $item->id) }}"
                                                                    class="avtar avtar-s btn-link-info btn-pc-default"><i
                                                                        class="ti ti-eye f-20"></i></a>
                                                            </li>
                                                            {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                title="Edit">
                                                                <a href="#"
                                                                    class="avtar avtar-s btn-link-success btn-pc-default"><i
                                                                        class="ti ti-edit f-20"></i></a>
                                                            </li> --}}
                                                            <li class="list-inline-item align-bottom"
                                                                data-bs-toggle="tooltip" title="Delete">

                                                                <a href="{{ route('agenda.destroy', $item->id) }}"
                                                                    class="avtar avtar-xs btn-link-danger btn-pc-default"
                                                                    data-confirm-delete="true"><i
                                                                        class="ti ti-trash f-18"></i></a>
                                                            </li>


                                                        </ul>
                                                    </td>
                                                </tr>
                                                @php
                                                    $counter++; // Increment counter setelah satu data ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-6-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-6" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-6">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Room</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Activity</th>
                                            <th>Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1; // Inisialisasi counter untuk nomor urut
                                        @endphp
                                        @foreach ($agenda as $item)
                                            @if ($item->status === 'Decline')
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto pe-0">
                                                                @if ($item->user->image)
                                                                    <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                        alt="{{ $item->image }}" height="40"
                                                                        class="wid-40 rounded-circle" />
                                                                @else
                                                                    <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                        alt="Photo Profile"
                                                                        class="wid-40 rounded-circle" />
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="mb-1">
                                                                    <span
                                                                        class="text-truncate w-100">{{ $item->user->name }}</span>
                                                                </h6>
                                                                <p class="f-12 mb-0">
                                                                    <a href="#!" class="text-muted"><span
                                                                            class="text-truncate w-100"><span
                                                                                class="__cf_email__"
                                                                                data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                                {{ $item->user->instansi }}</span></span></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->room->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                    <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                    <td>{{ $item->activities }}</td>
                                                    <td>{{ $item->reason }}</td>c
                                                </tr>
                                                @php
                                                    $counter++; // Increment counter setelah satu data ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="analytics-tab-5-pane" role="tabpanel"
                            aria-labelledby="analytics-tab-5" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple-5">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Room</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Activity</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1; // Inisialisasi counter untuk nomor urut
                                        @endphp
                                        @foreach ($dataPast as $item)
                                            @if ($item->status === 'Accept')
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto pe-0">
                                                                @if ($item->user->image)
                                                                    <img src="{{ asset('storage/' . $item->user->image) }}"
                                                                        alt="{{ $item->image }}" height="40"
                                                                        class="wid-40 rounded-circle" />
                                                                @else
                                                                    <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                                        alt="Photo Profile"
                                                                        class="wid-40 rounded-circle" />
                                                                @endif
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="mb-1">
                                                                    <span
                                                                        class="text-truncate w-100">{{ $item->user->name }}</span>
                                                                </h6>
                                                                <p class="f-12 mb-0">
                                                                    <a href="#!" class="text-muted"><span
                                                                            class="text-truncate w-100"><span
                                                                                class="__cf_email__"
                                                                                data-cfemail="d5b8b8a6bda1e7e695b2b8b4bcb9fbb6bab8">
                                                                                {{ $item->user->instansi }}</span></span></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->room->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                                                    <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                                                    <td>{{ $item->activities }}</td>
                                                </tr>
                                                @php
                                                    $counter++; // Increment counter setelah satu data ditampilkan
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
