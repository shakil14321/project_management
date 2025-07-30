<!DOCTYPE html>
<html>
<head>
    <title>Reminder</title>
</head>
<body>
    <h2>Hello {{ $project->user->name ?? 'User' }},</h2>
    <p>This is a reminder for your project: <strong>{{ $project->client }}</strong></p>
    <p><strong>Details:</strong> {{ $project->details }}</p>
    <p><strong>Reminder Date:</strong> {{ $project->reminder_date }}</p>

    <p>Thanks,<br>Your Project Manager App</p>
</body>
</html>
