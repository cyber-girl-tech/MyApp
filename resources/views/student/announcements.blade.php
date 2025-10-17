@extends('layouts.happy')

@section('title', 'Department Announcements')

@section('content')
<div class="container mt-4">
    <h3><i class="fa-solid fa-bullhorn"></i> Announcements</h3>
    @forelse($announcements as $a)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5>{{ $a->title }}</h5>
                <p>{{ $a->body }}</p>
                <small class="text-muted">Posted on {{ $a->created_at->format('d M Y') }}</small>
            </div>
        </div>
    @empty
        <p>No announcements available.</p>
        <!-- Button to open modal -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
  Add Announcement
</button>

<!-- Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('announcements.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addAnnouncementModalLabel">New Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" required></textarea>
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
    @endforelse
</div>
@endsection