<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
</head>
<body style="font-family: Arial; background:#f4f4f4; padding:20px;">

<div style="max-width:600px;margin:auto;background:#fff;border-radius:8px;padding:20px;">

    <h2 style="color:#0073e6;">New Job Application Received</h2>

    <p><strong>Full Name:</strong> {{ $application_details->full_name }}</p>

    <p><strong>Email:</strong> {{ $application_details->email }}</p>

    @if($application_details->phone)
        <p><strong>Phone:</strong> {{ $application_details->phone }}</p>
    @endif

    <p><strong>Career ID:</strong> {{ $application_details->career_id }}</p>

    @if($application_details->message)
        <p><strong>Message:</strong></p>
        <p>{{ $application_details->message }}</p>
    @endif

    @if($application_details->cv_file)
        <p>
            <strong>CV:</strong>
            <a href="{{ asset($application_details->cv_file) }}" target="_blank">Download CV</a>
        </p>
    @endif

    <hr>

    <small style="color:#777;">
        Submitted at: {{ $application_details->created_at }}
    </small>

</div>

</body>
</html>
