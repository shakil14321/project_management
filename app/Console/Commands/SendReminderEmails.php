<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use Carbon\Carbon;

class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send reminder emails to users on their selected date';

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $projects = Project::whereDate('reminder_date', $today)->with('user')->get();

        foreach ($projects as $project) {
            if ($project->user && $project->user->email) {
                Mail::to($project->user->email)->send(new ReminderMail($project));
                $this->info("Reminder sent to {$project->user->email}");
            }
        }
    }
}
