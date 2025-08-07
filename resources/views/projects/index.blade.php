@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>All Submitted Projects</h2>

        <form method="GET" action="{{ route('projects.index') }}" class="d-flex" style="gap: 10px;">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Search Name, Email, Number" 
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
        
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Create
        </a>

        <form method="GET" action="{{ route('projects.index') }}" class="row mb-4 g-3">
            <div class="col-md-3">
                <label>Date From</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label>Date To</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="">-- All --</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>processing
                    </option>
                    <option value="pipeline" {{ request('status') == 'pipeline' ? 'selected' : '' }}>pipeline</option>
                    <option value="confrom" {{ request('status') == 'confrom' ? 'selected' : '' }}>confrom</option>
                    <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>cancel</option>
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button class="btn btn-primary w-100" type="submit">Filter</button>
            </div>
        </form>

        {{-- <p><strong>Total Projects:</strong> {{ $projects->count() }}</p> --}}

        @if ($projects->count())
            <p><strong>Total Projects:</strong> {{ $projects->count() }}</p>
            {{-- <table class="table table-bordered table-striped">
                ...
            </table> --}}
        @else
            <p>No projects found.</p>
        @endif



        @if ($projects->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>client_requirement</th>
                        <th>Company Address</th>
                        <th>Details</th>
                        <th>Project Type</th>
                        <th>Proposal</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Remark</th>
                        <th>Reminder</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->date }}</td>
                            <td>{{ $project->Project_Name }}</td>
                            <td>{{ $project->client }}</td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $project->number) }}" target="_blank">
                                    {{ $project->number }}
                                </a>
                            </td>

                            <td>
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $project->email }}" target="_blank">
                                    {{ $project->email }}
                                </a>
                            </td>
                            <td>
                                @if ($project->client_requirement_text)
                                    {{ $project->client_requirement_text }}
                                @else
                                    N/A
                                @endif
                                <br>
                                @if ($project->client_requirement_file)
                                    <a href="{{ asset('storage/' . $project->client_requirement_file) }}" target="_blank">
                                        View File
                                    </a>
                                @else
                                    N/A
                                @endif

                            <td>{{ $project->company_address }}</td>

                            <td>{{ $project->details }}</td>
                            <td>
                                @if ($project->project_type)
                                    @foreach (json_decode($project->project_type) as $type)
                                        <span class="badge bg-primary">{{ $type }}</span>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>
                                @if ($project->proposal)
                                    <a href="{{ asset('storage/' . $project->proposal) }}" target="_blank">View file</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>৳{{ number_format($project->budget, 2) }}</td>
                            <td>{{ $project->status }}</td>
                           <td>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('projects.profile', $project->id) }}" class="btn btn-info btn-sm">Profile</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                           </td>
                            <td>{{ $project->remark ?? 'N/A' }}</td>
                            <td>
                                {{ $project->reminder_date ?? 'No Reminder' }}

                                <input data-id="{{ $project->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $project->reminder_date ? 'checked' : '' }}>
                                @php
                                    $reminder = $reminders->firstWhere('project_id', $project->id);
                                @endphp

                                @if ($reminder)
                                    <input data-id="{{ $reminder->id }}" class="toggle-class" type="checkbox"
                                        {{ $reminder->status ? 'checked' : '' }}
                                        data-toggle="toggle" data-on="Active" data-off="Inactive">
                                @else
                                    <span class="text-muted">No Reminder</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                $(function () {
                    $('.toggle-class').change(function () {
                        var status = $(this).prop('checked') ? 1 : 0;
                        var reminderId = $(this).data('id');

                        $.ajax({
                            type: "POST",
                            url: "/reminders/" + reminderId + "/toggle",
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: status
                            },
                            success: function (data) {
                                console.log(data);
                            },
                            error: function (xhr) {
                                alert('Error toggling reminder status.');
                            }
                        });
                    });
                });
            </script>

        @else
            <p>No projects found.</p>
        @endif
    </div>
@endsection