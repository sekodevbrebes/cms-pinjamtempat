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

                                        <div class="card-body position-absolute bottom-0 end-0">
                                            <ul class="list-inline ms-auto mb-0 prod-likes">
                                                <li class="list-inline-item m-0">
                                                    <a href="#"
                                                        class="avtar avtar-xs text-white text-hover-primary"><i
                                                            class="ti ti-zoom-in f-18"></i></a>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <a href="#"
                                                        class="avtar avtar-xs text-white text-hover-primary"><i
                                                            class="ti ti-zoom-out f-18"></i></a>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <a href="#"
                                                        class="avtar avtar-xs text-white text-hover-primary"><i
                                                            class="ti ti-rotate-clockwise f-18"></i></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Menampilkan gambar-gambar -->
                                        {{-- @if ($room->image)
                                            @foreach (json_decode($room->image) as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Room Image">
                                            @endforeach
                                        @endif --}}


                                        <div class="carousel-item active">
                                            <img src="../assets/images/application/img-prod-1.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-2.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-3.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-4.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-5.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-6.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-7.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>

                                        <div class="carousel-item">
                                            <img src="../assets/images/application/img-prod-8.jpg" class="d-block w-100"
                                                alt="Product images" />
                                        </div>
                                    </div>

                                    <ol
                                        class="carousel-indicators position-relative product-carousel-indicators my-sm-3 mx-0">
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                            class="w-25 h-auto active">
                                            <img src="../assets/images/application/img-prod-1.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-2.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-3.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-4.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-5.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-6.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-7.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7"
                                            class="w-25 h-auto">
                                            <img src="../assets/images/application/img-prod-8.jpg"
                                                class="d-block wid-50 rounded" alt="Product images" />
                                        </li>
                                    </ol>
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

                            <h5 class="mt-4 mb-3 f-w-500">Facility</h5>
                            <ul>
                                <li class="mb-2">Care Instructions: Hand Wash Only</li>
                                <li class="mb-2">Fit Type: Regular</li>
                                <li class="mb-2">Dark Blue Regular Women Jeans</li>
                                <li class="mb-2">Fabric : 100% Cotton</li>
                            </ul>



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
                        <div class="col-sm-6 col-xl-3">
                            <div class="card product-card">
                                <div class="card-img-top">
                                    <a href="ecom_product-details.html">
                                        <img src="../assets/images/application/img-prod-1.jpg" alt="image"
                                            class="img-prod img-fluid" />
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card product-card">
                                <div class="card-img-top">
                                    <a href="ecom_product-details.html"><img
                                            src="../assets/images/application/img-prod-2.jpg" alt="image"
                                            class="img-prod img-fluid" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card product-card">
                                <div class="card-img-top">
                                    <a href="ecom_product-details.html"><img
                                            src="../assets/images/application/img-prod-3.jpg" alt="image"
                                            class="img-prod img-fluid" /></a>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card product-card">
                                <div class="card-img-top">
                                    <a href="ecom_product-details.html"><img
                                            src="../assets/images/application/img-prod-4.jpg" alt="image"
                                            class="img-prod img-fluid" /></a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Base style - Hover table end -->
    </div>
    <!-- [ Main Content ] end -->


@endsection
