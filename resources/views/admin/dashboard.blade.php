<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
   @vite(['resources/sass/style.scss', 'resources/js/app.js'])
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
   <header>
    <section id="nav-bar">
<nav class="navbar navbar-expand-lg bg-body-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CYB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.announcement')}}">Announcements</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link"  href="{{route('admin.event')}}" >Events
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.timetable')}}">Timetables</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2"  type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    </section>
    <section id="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1>Cybersecurity Department Admin panel</h1>
            <p>Logged in as: <strong>{{ auth()->user()->name}}! (Admin)</strong></p>
          </div>
        </div>
      </div>
    </section>
  </section>
  </header>
          @extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4"><i class="fa-solid fa-gauge"></i> Admin Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Announcements</h5>
                    <p class="card-text display-6">{{ $announcementsCount ?? 0 }}</p>
                    <a href="#" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Events</h5>
                    <p class="card-text display-6">{{ $eventsCount ?? 0 }}</p>
                    <a href="#" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Timetables</h5>
                    <p class="card-text display-6">{{ $timetablesCount ?? 0 }}</p>
                    <a href="#" class="btn btn-primary btn-sm">Manage</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Updates Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <i class="fa-solid fa-clock-rotate-left"></i> Recent Updates
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUpdates ?? [] as $update)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($update->type) }}</td>
                            <td>{{ $update->title }}</td>
                            <td>{{ $update->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No recent updates</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
       
        <
    </header>

</html>