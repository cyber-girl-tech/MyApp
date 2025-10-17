@extends('layouts.app')

@section('title', 'Department Announcements')

@section('content')
<div class="container mt-4">
    <h3><i class="fa-solid fa-bullhorn"></i> Announcements</h3>

    <!-- Add Announcement Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
        Add Announcement
    </button>
@forelse($announcement as $a)
    <!-- Announcements List -->
    
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
              
                <h5>{{ $a->title }}</h5>
                <p>{{ $a->body }}</p>
                <small class="text-muted">Posted on {{ $a->created_at->format('d M Y') }}</small>
                <div class="mt-2">
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $a->id }}">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAnnouncementModal{{ $a->id }}">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editAnnouncementModal{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('announcement.update', $a->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ $a->title }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Body</label>
                                <textarea name="body" class="form-control" required>{{ $a->body }}</textarea>
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

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteAnnouncementModal{{ $a->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('announcement.destroy', $a->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this announcement?
                            <p><strong>{{ $a->title }}</strong></p>
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
        <p>No announcements available.</p>
    @endforelse

    <!-- Add Modal -->
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('announcement.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Body</label>
                            <textarea name="body" class="form-control" required></textarea>
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