<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Models\Project;

class ReminderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
        ]);

        Reminder::create([
            'text' => $request->text,
            'link' => $request->link,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Reminder added!');
    }

    public function chaggeProjectStatus(Request $request, $id)
    {

        $reminder = Reminder::findOrFail($id);
        $reminder->status = $request->status; // expects '1' or '0'
        $reminder->save();

        return response()->json(['success' => true, 'status' => $reminder->status]);
    }
}
