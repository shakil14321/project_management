<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Project</h2>

    <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 w-25">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $project->date }}">
        </div>

        <div class="mb-3 w-25">
            <label>Client Name</label>
            <input type="text" name="client" class="form-control" value="{{ $project->client }}">
        </div>

        <div class="mb-3 w-25">
            <label>WhatsApp Number</label>
            <input type="text" name="number" class="form-control" value="{{ $project->number }}">
        </div>

        <div class="mb-3 w-25">
            <label>Company Address</label>
            <input type="text" name="company_address" class="form-control" value="{{ $project->company_address }}">
        </div>

        <div class="mb-3 w-25">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $project->email }}">
        </div>

        <div class="mb-3 w-50">
            <label>Project Details</label>
            <textarea name="details" class="form-control">{{ $project->details }}</textarea>
        </div>

        {{-- ✅ Project Type Dropdown with Checkboxes --}}
        <div class="mb-3 w-50">
            <label>Project Type</label>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Project Type
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 100%;">
                    @php
                        $selectedTypes = is_array($project->project_type) ? $project->project_type : json_decode($project->project_type, true);
                        $options = ['Website', 'Mobile App', 'Desktop Application', 'Other'];
                    @endphp
                    @foreach($options as $option)
                        <li>
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="project_type[]"
                                    value="{{ $option }}"
                                    class="form-check-input"
                                    id="type_{{ $loop->index }}"
                                    {{ in_array($option, $selectedTypes ?? []) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="type_{{ $loop->index }}">{{ $option }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mb-3 w-25">
            <label>Proposal (File)</label>
            @if($project->proposal)
                <p>Current: <a href="{{ asset('storage/' . $project->proposal) }}" target="_blank">View File</a></p>
            @endif
            <input type="file" name="proposal" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Budget</label>
            <input type="number" name="budget" class="form-control" value="{{ $project->budget }}">
        </div>

        <div class="mb-3 w-25">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="processing" {{ $project->status == 'processing' ? 'selected' : '' }}>processing</option>
                <option value="pipeline" {{ $project->status == 'pipeline' ? 'selected' : '' }}>pipeline</option>
                <option value="confrom" {{ $project->status == 'confrom' ? 'selected' : '' }}>confrom</option>
                <option value="cancel" {{ $project->status == 'cancel' ? 'selected' : '' }}>cancel</option>
            </select>
        </div>

        <button class="btn btn-success">Update Project</button>
    </form>
</div>

{{-- ✅ Include Bootstrap JavaScript for dropdown to work --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
