<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('backend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Section -->
        @include('backend.partials.sidebar')

        <div class="content">
            <!-- Header Section -->
            @include('backend.partials.header')

            <!-- Content Section -->
            <main>
                @yield('content')
            </main>

            <!-- Footer Section -->
            @include('backend.partials.footer')

        </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Common JS files -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="backend/lib/chart/chart.min.js"></script>
    <script src="backend/lib/easing/easing.min.js"></script>
    <script src="backend/lib/waypoints/waypoints.min.js"></script>
    <script src="backend/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="backend/lib/tempusdominus/js/moment.min.js"></script>
    <script src="backend/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="backend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>


    <!-- Template Javascript -->
    <script src="backend/js/main.js"></script>
    @stack('scripts')
</body>
</html>
