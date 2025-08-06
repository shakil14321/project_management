<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

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

    public function toggle($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->is_active = !$reminder->is_active;
        $reminder->save();

        return redirect()->back();
    }
}
