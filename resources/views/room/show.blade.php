@extends('layouts.app')

@section('title', 'Data Tempat/Ruangan')

@section('contents')
    <div class="row">
        <!-- Base style - Hover table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sticky-md-top product-sticky">
                                <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner bg-light rounded position-relative">
                                        <div class="card-body position-absolute end-0 top-0">
                                            <div class="form-check prod-likes">
                                                <input type="checkbox" class="form-check-input" />
                                                <i data-feather="heart" class="prod-likes-icon"></i>
                                            </div>
                                        </div>


                                        <!-- Menampilkan gambar-gambar -->

                                        @if ($room->image)
                                            @foreach (json_decode($room->image) as $image)
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('storage/' . $image) }}" class="d-block w-100"
                                                        height="100%" alt="Room Image">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    {{-- <ol
                                        class="carousel-indicators position-relative product-carousel-indicators my-sm-3 mx-0">
                                        @if ($room->image)
                                            @foreach (json_decode($room->image) as $image)
                                                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                                                    class="w-25 h-auto active">
                                                    <img src="{{ asset('storage/' . $image) }}"
                                                        class="d-block wid-50 rounded" />
                                                </li>
                                            @endforeach
                                        @endif
                                    </ol> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="badge bg-success f-14"> {{ $room->name }}</span>
                            <h3 class="my-3">
                                {{ $room->name }}
                            </h3>
                            <div class="star f-18 mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                                <i class="far fa-star text-muted"></i>
                                <span class="text-sm text-muted">(4.0)</span>
                            </div>

                            <p>Capacity: Maksimal {{ $room->capacity }} Orang</p>

                            <h5 class="mt-4 mb-3 f-w-500">Facility</h5>

                            {!! $room->facility !!}

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Room Image</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        @if ($room->image)
                            @foreach (json_decode($room->image) as $image)
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card product-card">
                                        <div class="card-img-top">
                                            <a href="ecom_product-details.html">
                                                <img src="{{ asset('storage/' . $image) }}" class="img-prod img-fluid"
                                                    alt="Room Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Base style - Hover table end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection
