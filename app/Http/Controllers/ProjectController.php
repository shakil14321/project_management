<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'date' => 'required|date',
            'client' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
            'company_address' => 'required|string',
            'details' => 'nullable|string',
            'project_type' => 'nullable|array',
            'proposal.*' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'budget' => 'nullable|numeric',
            'status' => 'nullable|string',
            'reminder_date' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        // Handle file upload
        $pdfPaths = [];
        if ($request->hasFile('proposal')) {
            foreach ($request->file('proposal') as $file) {
                $path = $file->store('proposals', 'public');
                $pdfPaths[] = $path;
            }
        }

        // Save to database
        Project::create([
            'date' => $request->date,
            'client' => $request->client,
            'number' => $request->number,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'details' => $request->details,
            'project_type' => json_encode($request->project_type),
            'proposal' => json_encode($pdfPaths),
            'budget' => $request->budget,
            'status' => $request->status,
            'reminder_date' => $request->reminder_date,
            'remark' => $request->remark,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project saved successfully!');
    }

    public function index(Request $request)
    {
        $query = Project::query();

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.profile', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        // Validate inputs
        $request->validate([
            'date' => 'required|date',
            'client' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
            'company_address' => 'required|string',
            'details' => 'nullable|string',
            'project_type' => 'nullable|array',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'budget' => 'nullable|numeric',
            'status' => 'nullable|string',
            'reminder_date' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        // Handle new file upload (if exists)
        if ($request->hasFile('proposal')) {
            $pdfPath = $request->file('proposal')->store('proposals', 'public');
            $project->proposal = json_encode([$pdfPath]);
        }

        // Update other fields
        $project->update([
            'date' => $request->date,
            'client' => $request->client,
            'number' => $request->number,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'details' => $request->details,
            'project_type' => json_encode($request->project_type),
            'budget' => $request->budget,
            'status' => $request->status,
            'reminder_date' => $request->reminder_date,
            'remark' => $request->remark,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
