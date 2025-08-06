<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'Project_Name' => 'required|string|max:255',
            'client' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
            'client_requirement_text' => 'required|string',
            'client_requirement_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'company_address' => 'required|string',
            'details' => 'nullable|string',
            'project_type' => 'nullable|array',
            'proposal.*' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'budget' => 'nullable|numeric',
            'status' => 'nullable|string',
            'reminder_date' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        $pdfPaths = [];
        if ($request->hasFile('proposal')) {
            foreach ($request->file('proposal') as $file) {
                $pdfPaths[] = $file->store('proposals', 'public');
            }
        }

        $filePath = null;
        if ($request->hasFile('client_requirement_file')) {
            $filePath = $request->file('client_requirement_file')->store('client_requirements', 'public');
        }

        Project::create([
            'date' => $request->date,
            'Project_Name' => $request->Project_Name,
            'client' => $request->client,
            'number' => $request->number,
            'email' => $request->email,
            'client_requirement_text' => $request->client_requirement_text,
            'client_requirement_file' => $filePath,
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

        // Filter by search keyword in Project_Name, email, or number
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('Project_Name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('number', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // $projects = $query->latest()->get();
        $projects = $query->orderBy('date', 'desc')->get();

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

        $request->validate([
            'date' => 'required|date',
            'Project_Name' => 'required|string|max:255',
            'client' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
            'client_requirement_text' => 'required|string',
            'client_requirement_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'company_address' => 'required|string',
            'details' => 'nullable|string',
            'project_type' => 'nullable|array',
            'proposal.*' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'budget' => 'nullable|numeric',
            'status' => 'nullable|string',
            'reminder_date' => 'nullable|date',
            'remark' => 'nullable|string',
        ]);

        // Handle new client requirement file
        $clientRequirementPath = $project->client_requirement_file; // default to existing
        if ($request->hasFile('client_requirement_file')) {
            $clientRequirementPath = $request->file('client_requirement_file')->store('client_requirements', 'public');
        }

        // Handle new proposal files
        $proposalPaths = json_decode($project->proposal ?? '[]');
        if ($request->hasFile('proposal')) {
            $proposalPaths = [];
            foreach ($request->file('proposal') as $file) {
                $proposalPaths[] = $file->store('proposals', 'public');
            }
        }

        $project->update([
            'date' => $request->date,
            'Project_Name' => $request->Project_Name,
            'client' => $request->client,
            'number' => $request->number,
            'email' => $request->email,
            'client_requirement_text' => $request->client_requirement_text,
            'client_requirement_file' => $clientRequirementPath,
            'company_address' => $request->company_address,
            'details' => $request->details,
            'project_type' => json_encode($request->project_type),
            'proposal' => json_encode($proposalPaths),
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
