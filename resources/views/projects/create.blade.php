<!DOCTYPE html>
<html>
<head>
    <title>Add New Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Add New Project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="d-flex flex-wrap gap-3">
            <div class="mb-3 w-25">
                <label>Date</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label>Reminder Date</label>
                <input type="date" name="reminder_date" class="form-control" value="{{ old('reminder_date', $project->reminder_date ?? '') }}">
            </div>

            <div class="mb-3 w-25">
                <label>Project Name</label>
                <input type="text" name="Project_Name" value="{{ old('Project_Name') }}" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label>Client name</label>
                <input type="text" name="client" value="{{ old('client') }}" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label>Number</label>
                <input type="text" name="number" value="{{ old('number') }}" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="mb-3 w-50">
                <label class="form-label">Client Requirements</label>

                <textarea name="client_requirement_text" class="form-control mb-2" rows="4" required>{{ old('client_requirement_text', $project->client_requirement_text ?? '') }}</textarea>

                <input type="file" name="client_requirement_file" class="form-control">

                @if(!empty($project->client_requirement_file))
                    <small class="text-muted mt-1 d-block">
                        Current File: <a href="{{ asset('storage/' . $project->client_requirement_file) }}" target="_blank">View</a>
                    </small>
                @endif
            </div>


            <div class="mb-3 w-50">
                <label>Company Address</label>
                <input type="text" name="company_address" value="{{ old('company_address') }}" class="form-control">
            </div>
        </div>

        <div class="mb-3 w-50">
            <label>Project Details</label>
            <textarea name="details" class="form-control" rows="3">{{ old('details') }}</textarea>
        </div>

        <div class="mb-3 w-50">
            <label>Project Type</label>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Project Type
                </button>
                <ul class="dropdown-menu p-3" style="min-width: 100%;">
                    @php
                        $selectedTypes = old('project_type', []);
                        $options = ['Website', 'Mobile App', 'Desktop Application', 'Other'];
                    @endphp
                    @foreach($options as $option)
                        <li>
                            <div class="form-check">
                                <input type="checkbox" name="project_type[]" value="{{ $option }}" class="form-check-input"
                                    id="type_{{ $loop->index }}"
                                    {{ in_array($option, $selectedTypes ?? []) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_{{ $loop->index }}">{{ $option }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <div class="mb-3 w-25">
                <label>Upload Proposal (PDF/DOC/DOCX)</label>
                <input type="file" name="proposal[]" class="form-control" accept=".pdf,.doc,.docx" multiple>
            </div>

            <div class="mb-3 w-25">
                <label>Project Budget (BDT)</label>
                <input type="number" name="budget" class="form-control">
            </div>

            <div class="mb-3 w-25">
                <label>Status</label>
                <select name="status" class="form-select">
                    @php
                        $statuses = ['processing', 'pipeline', 'confrom', 'cancel'];
                    @endphp
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 w-50">
            <label class="form-label">Reminder Text</label>
            <input type="text" name="reminder_text" class="form-control" value="{{ old('reminder_text') }}">

            <label class="form-label mt-2">Reminder Link (optional)</label>
            <input type="url" name="reminder_link" class="form-control" value="{{ old('reminder_link') }}">
        </div>



        <div class="mb-3 w-50">
            <label>Remark</label>
            <textarea name="remark" class="form-control" rows="3">{{ old('remark', $project->remark ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
