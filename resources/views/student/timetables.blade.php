@extends('layouts.happy')

@section('title', 'Student Timetables')

@section('content')
<div class="container mt-4">
    <h3><i class="fa-solid fa-clock"></i> Class Timetables</h3>
                <table class="table table-striped table-hover table-bordered table-hover">
                    <thead>
                    <th><strong>Course code</strong></th>
                    <th><strong>Level</strong></th>
                    <th><strong>Course Title</strong></th>
                    <th><strong>Day</strong></th>
                    <th><strong>Time</strong></th>
                     </thead>
                <tbody>
                    @forelse($timetables as $t)
                        <tr>
                        <td>{{ $t->course_name }}</td>
                        <td>{{ $t->level }}</td>
                         <td> {{ $t->description }}</td>
                         <td> {{ $t->day }}</td>
                         <td> {{ $t->time }}</td>
                         </tr>
                     
    @empty
        <p>No timetables available.</p>
    @endforelse
</tbody>
</table>
@endsection
