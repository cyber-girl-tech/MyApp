<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Info Board</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-KbW9M7w8u2u6jPVyLgmMNHp3MAV6lT0uAkR7F6KbrkAVPuqZzFy0fSBd5YoltiH/jKU1zrrbN9zW7U4TlhI4Q=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .navbar {
            background: #0d6efd;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center py-3 border-bottom border-secondary">Admin Panel</h4>
        <a href="{{route('admin.dashboard')}}" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="{{route('admin.announcement')}}"><i class="fa-solid fa-bullhorn"></i>Announcements</a>
        <a href="{{route('admin.event')}}"><i class="fa-solid fa-calendar-days"></i> Events</a>
        <a href="{{route('admin.timetable')}}"><i class="fa-solid fa-table"></i> Timetable</a>
        <a href="{{ route('admin.user.create') }}" class="btn btn-info"><i class="fa-solid fa-user-plus"></i> Add New User</a>
        <form action="/logout" method="POST">
          @csrf
          <button class="btn btn-primary" type="submit"> LOG OUT</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Department Info Board</a>
                <form class="d-flex" role="search">
        <input class="form-control me-2"  type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
            </div>
        </nav>

        <!-- Dynamic Page Content -->
        <div>
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>