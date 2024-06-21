<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Si KPT - @yield('title')</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistem Ketersediaan Pinjam Tempat">
    <meta name="keywords" content="Sistem Ketersediaan Pinjam Tempat">
    <meta name="Sus Hardianto" content="Sus Hardianto">
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link">
    <!-- [Page specific CSS] start -->
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}" />
    <!-- [Page specific CSS] end -->

    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/phosphor/duotone/style.css') }}">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('/assets/fonts/material.css') }}">
    <!-- [Button Pagination On User Table CSS Files] -->
    <link rel="stylesheet" href="{{ asset('/assets/css/plugins/style.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('/assets/css/style-preset.css') }}">

</head>
<!-- [Head] end -->

<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light"><!-- [ Pre-loader ] start -->
    <div class="page-loader">
        <div class="bar"></div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    @includeIf('layouts.partials.sidebar')
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    @includeIf('layouts.partials.header')
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content"><!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">@yield('title')</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0"> @yield('title')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ content ] start -->
                @yield('contents')
                <!-- [ content ] end -->
            </div><!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->


    <!-- [ Footer] start  -->
    @includeIf('layouts.partials.footer')
    <!-- [ Footer] end -->



    <!-- Required Js -->
    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/feather.min.js') }}"></script>
    <!-- [Page Specific JS] start -->

    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/assets/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('/assets/js/plugins/simple-datatables.js') }}"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#pc-dt-simple", {
            sortable: false,
            perPage: 5,
        });
    </script>


    {{-- <script>
        // [ base style ]
        $('#base-style').DataTable();

        // [ no style ]
        $('#no-style').DataTable();

        // [ compact style ]
        $('#compact').DataTable();

        // [ hover style ]
        $('#table-style-hover').DataTable();
    </script> --}}

    @include('sweetalert::alert')
</body>
<!-- [Body] end -->

</html>
