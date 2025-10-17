@extends('layouts.happy')

@section('title', 'Department Events')

@section('content')
<div class="container mt-4">
    <h3><i class="fa-solid fa-calendar-days"></i> Upcoming Events</h3>
    @forelse($events as $event)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $event->title }}</h5>
                <p>{{ $event->description }}</p>
                <small class="text-muted">Date: {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</small>
            </div>
        </div>
    @empty
        <p>No events scheduled.</p>
    @endforelse
</div>
@endsection
