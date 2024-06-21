@extends('layouts.app')

@section('title', 'Data Users')

@section('contents')
    <div class="row">
        <!-- Base style - Hover table start -->
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header pb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-3 mb-sm-0">@yield('title')</h5>

                        <a href="{{ route('users.create') }}"
                            class="btn btn-primary d-inline-flex align-items-center gap-2"><i class="ti ti-plus f-18"></i>Add
                            User</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive pt-4">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Instansi</th>
                                    <th>Alamat</th>
                                    <th>Level</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-auto">
                                                    @if ($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}"
                                                            alt="{{ $item->image }}" height="40"
                                                            class="wid-40 rounded-circle" />
                                                    @else
                                                        <img src="{{ asset('storage/assets/image-user/profil-kosong.jpg') }}"
                                                            alt="Photo Profile" class="wid-40 rounded-circle" />
                                                    @endif
                                                    {{-- <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                                                        class="wid-40 rounded-circle" /> --}}

                                                </div>
                                                <div class="col">
                                                    <h6 class="mb-0">{{ $item->name }}</h6>
                                                    <p class="text-muted f-12 mb-0">
                                                        {{ $item->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->telephone }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->roles }}</td>

                                        <td class="text-center">
                                            <ul class="list-inline me-auto mb-0">
                                                {{-- <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    title="View">
                                                    <a href="#"
                                                        class="avtar avtar-xs btn-link-secondary btn-pc-default"
                                                        data-bs-toggle="modal" data-bs-target="#customer-modal"><i
                                                            class="ti ti-eye f-18"></i></a>
                                                </li> --}}
                                                @if ($item->id != 1)
                                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <a href="#"
                                                            class="avtar avtar-xs btn-link-success btn-pc-default"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#customer-edit_add-modal"><i
                                                                class="ti ti-edit-circle f-18"></i></a>
                                                    </li>

                                                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                        title="Delete">

                                                        {{-- <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                    class="d-inline" data-confirm-delete="true">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form> --}}

                                                        {{-- <a href="{{ route('users.destroy', $item->id) }}"
                                                    class="btn btn-danger" data-confirm-delete="true">Delete</a> --}}

                                                        {{-- <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="ti ti-trash f-18"></i> Delete
                                                    </button>
                                                </form> --}}


                                                        <a href="{{ route('users.destroy', $item->id) }}"
                                                            data-confirm-delete="true"
                                                            class="avtar avtar-xs btn-link-danger btn-pc-default">
                                                            <i class="ti ti-trash f-18"></i></a>
                                                    </li>
                                                @else
                                                @endif

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h5 class="mb-3 mb-sm-0">@yield('title')</h5>
                        
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>

                                    <th>Instansi</th>
                                    <th>Telephone</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->telephone }}</td>
                                        <td class="d-flex">
                                            <a href="#" class="avtar avtar-xs btn-link-secondary"><i
                                                    class="ti ti-eye f-20"></i>
                                            </a><a href="#" class="avtar avtar-xs btn-link-secondary">
                                                <i class="ti ti-edit f-20"></i>
                                            </a>

                                            <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit"
                                                    class="avtar avtar-xs btn-link-secondary dropdown-item">
                                                    <i class="ti ti-trash f-20"></i>
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Base style - Hover table end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection
