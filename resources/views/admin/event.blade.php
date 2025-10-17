@extends('layouts.app')

@section('title', 'Event Management')

@section('content')
<div class="container mt-4">
    <h3><i class="fa-solid fa-calendar-check"></i> Event Management</h3>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEventModal">
        Add New Event
    </button>

@forelse($event as $e)
    <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $e->title }}</h5>
                <p>{{ $e->description }}</p>
                <p><strong>Location:</strong> {{ $e->location }}</p>
                <small class="text-muted">
                    Start: {{ $e->start_time->format('d M Y h:i A') }} | 
                    End: {{ $e->end_time->format('d M Y h:i A') }}
                </small>
                <div class="mt-2">
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $e->id }}">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteEventModal{{ $e->id }}">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editEventModal{{ $e->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('event.update', $e->id) }}">
                        @csrf
                         @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ $e->title }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" required>{{ $e->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Location</label>
                                <input type="text" name="location" value="{{ $e->location }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Start Time</label>
                                {{-- Use datetime-local input and format for compatibility --}}
                                <input type="datetime-local" name="start_time" value="{{ $e->start_time->format('Y-m-d\TH:i') }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>End Time</label>
                                <input type="datetime-local" name="end_time" value="{{ $e->end_time->format('Y-m-d\TH:i') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteEventModal{{ $e->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('event.destroy', $e->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the event:
                            <p><strong>{{ $e->title }}</strong></p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @empty
        <p>No events available for management.</p>
    @endforelse

    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('event.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Start Time</label>
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>End Time</label>
                            <input type="datetime-local" name="end_time" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection