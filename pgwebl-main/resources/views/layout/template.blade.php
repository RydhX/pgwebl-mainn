<!doctype html>
<html lang="en">

<head>

    <title>PGWL Doci</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('styles')

</head>

<body>

    @include('components.navbar')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    @yield('scripts')

    @include('components.toast')

    <style>
        .custom-navbar {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .custom-navbar .nav-tabs .nav-link {
            color: #6b7280;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border: none;
        }

        .custom-navbar .nav-tabs .nav-link.active {
            color: #6366f1;
            border-bottom: 2px solid #6366f1;
            background-color: transparent;
        }

        .custom-navbar .search-icon,
        .custom-navbar .wishlist-icon,
        .custom-navbar .notification-icon {
            font-size: 1.2rem;
            color: #6b7280;
            cursor: pointer;
        }

        .custom-navbar .avatar {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
        }
</body>

</html>
