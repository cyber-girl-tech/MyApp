@extends('layouts.app')

@section('title', 'Student Timetables')

@section('content')

    <h3><i class="fa-solid fa-clock"></i> Class Timetables</h3>
        
                <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTimetableModal">
        Add Timetable
    </button>

    <!-- Timetable Table -->
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Level</th>
                <th>Course Title</th>
                <th>Day</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($timetable as $t)
                <tr>
                    <td>{{ $t->course_name }}</td>
                   <td>{{ $t->level }}</td>
                    <td>{{ $t->description }}</td>
                    <td>{{ $t->day }}</td>
                    <td>{{ $t->time }}</td>
                    <td>
                        <!-- Edit button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editTimetableModal{{ $t->id }}">Edit</button>

                        <!-- Delete button -->
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteTimetableModal{{ $t->id }}">Delete</button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editTimetableModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('timetable.update', $t->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Timetable</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="course_name" class="form-control mb-2"
                                           value="{{ $t->course_name }}" placeholder="Course Code">
                                           <select name="level" class="form-select mb-2">
                                        <option value="100" {{ $t->level == '100' ? 'selected' : '' }}>100</option>
                                        <option value="200" {{ $t->level == '200' ? 'selected' : '' }}>200</option>
                                        <option value="300" {{ $t->level == '300' ? 'selected' : '' }}>300</option>
                                        <option value="400" {{ $t->level == '400' ? 'selected' : '' }}>400</option>
                                        <option value="500" {{ $t->level == '500' ? 'selected' : '' }}>500</option>
                                    </select>
                                    <input type="text" name="description" class="form-control mb-2"
                                           value="{{ $t->description}}" placeholder="Course Title">
                                    <input type="text" name="day" class="form-control mb-2"
                                           value="{{ $t->day }}" placeholder="Day">
                                    <input type="text" name="time" class="form-control mb-2"
                                           value="{{ $t->time }}" placeholder="Time">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteTimetableModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('timetable.destroy', $t->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $t->course_name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="7" class="text-center">No timetables found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Add Timetable Modal -->
<div class="modal fade" id="addTimetableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('timetable.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Timetable</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="course_name" class="form-control mb-2" placeholder="Course Code" required>
                    <select name="level" class="form-select mb-2">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>
                    <input type="text" name="description" class="form-control mb-2" placeholder="Course Title" required>
                    <input type="text" name="day" class="form-control mb-2" placeholder="Day" required>
                    <input type="text" name="time" class="form-control mb-2" placeholder="Time" required>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Timetable</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
