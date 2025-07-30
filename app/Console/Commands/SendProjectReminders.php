<?php

use App\Models\Project;
use App\Mail\ProjectReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendProjectReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send project reminder emails on reminder date';

    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $projects = Project::whereDate('reminder_date', $today)->get();

        foreach ($projects as $project) {
            if ($project->user && $project->user->email) {
                Mail::to($project->user->email)->send(new ProjectReminderMail($project));
                $this->info("Reminder sent to: " . $project->user->email);
            }
        }

        return 0;
    }
}
