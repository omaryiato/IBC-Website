<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body style="font-family: Arial; background:#f4f4f4; padding:20px;">

<div style="max-width:600px;margin:auto;background:#fff;border-radius:8px;padding:20px;">

    <h2 style="color:#0073e6;">New Job Application Received</h2>

    <p><strong>Full Name:</strong> {{ $application->full_name }}</p>

    <p><strong>Email:</strong> {{ $application->email }}</p>

    @if($application->phone)
        <p><strong>Phone:</strong> {{ $application->phone }}</p>
    @endif

    <p><strong>Career ID:</strong> {{ $application->career_id }}</p>

    @if($application->message)
        <p><strong>Message:</strong></p>
        <p>{{ $application->message }}</p>
    @endif

    @if($application->cv_file)
        <p>
            <strong>CV:</strong>
            <a href="{{ asset($application->cv_file) }}" target="_blank">Download CV</a>
        </p>
    @endif

    <hr>

    <small style="color:#777;">
        Submitted at: {{ $application->created_at }}
    </small>

</div>

</body>
</html>
