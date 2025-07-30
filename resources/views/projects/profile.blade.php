@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Project Profile</h2>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary mb-3">Back to List</a>

        <div class="card p-4">
            <p><strong>Date:</strong> {{ $project->date }}</p>
            <p><strong>Client:</strong> {{ $project->client }}</p>
            <p><strong>Number:</strong> {{ $project->number }}</p>
            <p><strong>Email:</strong> {{ $project->email }}</p>
            <p><strong>Company Address:</strong> {{ $project->company_address }}</p>
            <p><strong>Details:</strong> {{ $project->details }}</p>
            <p><strong>Project Type:</strong>
                @if(is_array($project->project_type))
                    {{ implode(', ', $project->project_type) }}
                @else
                    {{ $project->project_type }}
                @endif
            <p><strong>Budget:</strong> BDT {{ number_format($project->budget, 2) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>

            <h5>Project Proposals</h5>
                @php
                    $files = json_decode($project->proposal, true);
                @endphp

                @if ($files && count($files))
                    <ul>
                        @foreach ($files as $file)
                            <li>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank">View PDF</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No proposals uploaded.</p>
                @endif

                
            <p><strong>Remark:</strong> {{ $project->remark ?? 'N/A' }}</p>
        </div>
    </div>
@endsection
        