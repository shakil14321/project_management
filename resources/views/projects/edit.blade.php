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
          
        <div class="d-flex ">
            <div class="mb-3 w-25">
                 <label>Date</label>
                   <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
            </div>

            <div class="mb-3 w-25 ms-2">
                <label>Reminder Date</label>
                <input type="date" name="reminder_date" class="form-control" value="{{ old('reminder_date', $project->reminder_date ?? '') }}">
            </div>
       
            <div class="mb-3 w-25 ms-2">
                <label>Project Name</label>
                <input type="text" name="Project_Name" class="form-control" value="{{ old('Project_Name', $project->Project_Name) }}">
            </div>

            <div class="mb-3 w-25 ms-2">
                <label>Client name</label>
                <input type="text" name="client" class="form-control" value="{{ old('client', $project->client) }}">
            </div>

            <div class="mb-3 w-25 ms-2">
                <label>Number</label>
                <input type="text" name="number" class="form-control" value="{{ old('number', $project->number) }}">
            </div>

            <div class="mb-3 w-25 ms-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $project->email) }}">
            </div>

            <div class="mb-3 w-50">
                <label class="form-label">Client Requirements</label>

                <textarea name="client_requirement_text" class="form-control mb-2" rows="4">{{ old('client_requirement_text', $project->client_requirement_text ?? '') }}</textarea>

                <input type="file" name="client_requirement_file" class="form-control">

                @if(!empty($project->client_requirement_file))
                    <small class="text-muted mt-1 d-block">
                        Current File: <a href="{{ asset('storage/' . $project->client_requirement_file) }}" target="_blank">View</a>
                    </small>
                @endif
            </div>

            <div class="mb-3 w-25 ms-2">
                <label>Company Address</label>
                <input type="text" name="company_address" class="form-control" value="{{ old('company_address', $project->company_address) }}">
            </div>

        </div>

            <div class="mb-3 w-50 ms-2">
                <label>Project Details</label>
                <textarea name="details" class="form-control">{{ $project->details }}</textarea>
            </div>

</div>

        <div class="container mt-5">

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


            <div  class="d-flex ">
                
                <div class="mb-3 w-25">
                    <label>Proposal (File)</label>
                    @if($project->proposal)
                        <p>Current: <a href="{{ asset('storage/' . $project->proposal) }}" target="_blank">View File</a></p>
                    @endif
                    <input type="file" name="proposal[]" class="form-control" multiple>
                </div>

                <div class="mb-3 w-25 ms-2">
                    <label>Budget</label>
                    <input type="number" name="budget" class="form-control" value="{{ old('budget', $project->budget ?? '') }}">
                </div>


                <div class="mb-3 w-25 ms-2">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="processing" {{ old('status', $project->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="pipeline" {{ old('status', $project->status) == 'pipeline' ? 'selected' : '' }}>Pipeline</option>
                        <option value="confrom" {{ old('status', $project->status) == 'confrom' ? 'selected' : '' }}>Confrom</option>
                        <option value="cancel" {{ old('status', $project->status) == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                </div>


        </div>
        

        <div class="mb-3 w-50">
            <label>Remark</label>
            <textarea name="remark" class="form-control" rows="3">{{ old('remark', $project->remark ?? '') }}</textarea>
        </div>

        <button class="btn btn-success">Update Project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
</div>

        </div>

        

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
