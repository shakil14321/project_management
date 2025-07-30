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

        <div class="mb-3 w-25">
            <label>Date</label>
            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Client</label>
            <input type="text" name="client" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Number</label>
            <input type="text" name="number" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Company Address</label>
            <input type="text" name="company_address" class="form-control">
        </div>

        <div class="mb-3 w-50">
            <label>Project Details</label>
            <textarea name="details" class="form-control" rows="3"></textarea>
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

        <div class="mb-3">
            <label>Project Proposal (PDF)</label>
            <input type="file" name="proposal" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Project Budget (BDT)</label>
            <input type="number" name="budget" class="form-control">
        </div>

        <div class="mb-3 w-25">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="processing">Processing</option>
                <option value="pipeline">Pipeline</option>
                <option value="confrom">Confrom</option>
                <option value="cancel">Cancel</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
