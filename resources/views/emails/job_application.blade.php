<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Job Application</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f9;padding:30px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table width="650" cellpadding="0" cellspacing="0"
                        style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#0f172a;padding:30px;text-align:center;">

                            <img
                                src="{{ asset('logo.png') }}"
                                alt="IBC Group"
                                width="120"
                                style="display:block;margin:0 auto 15px auto;">

                            <h1 style="margin:0;color:#ffffff;font-size:24px;">
                                New Job Application
                            </h1>

                            <p style="margin:8px 0 0;color:#cbd5e1;font-size:14px;">
                                A new candidate has submitted an application
                            </p>

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:35px;">

                            <p style="margin-top:0;color:#334155;font-size:15px;">
                                Hello Team,
                            </p>

                            <p style="color:#475569;font-size:15px;line-height:1.6;">
                                A new job application has been received through the website.
                                Below are the applicant details:
                            </p>

                            <!-- Applicant Details -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                    style="border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;">

                                <tr>
                                    <td width="35%"
                                        style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;border-bottom:1px solid #e2e8f0;">
                                        Full Name
                                    </td>
                                    <td style="padding:14px;color:#475569;border-bottom:1px solid #e2e8f0;">
                                        {{ $application_details->full_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;border-bottom:1px solid #e2e8f0;">
                                        Email Address
                                    </td>
                                    <td style="padding:14px;color:#475569;border-bottom:1px solid #e2e8f0;">
                                        {{ $application_details->email }}
                                    </td>
                                </tr>

                                @if($application_details->phone)
                                <tr>
                                    <td style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;border-bottom:1px solid #e2e8f0;">
                                        Phone Number
                                    </td>
                                    <td style="padding:14px;color:#475569;border-bottom:1px solid #e2e8f0;">
                                        {{ $application_details->phone }}
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <td style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;border-bottom:1px solid #e2e8f0;">
                                        Career ID
                                    </td>
                                    <td style="padding:14px;color:#475569;border-bottom:1px solid #e2e8f0;">
                                        #{{ $application_details->career_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;border-bottom:1px solid #e2e8f0;">
                                        Career Titel
                                    </td>
                                    <td style="padding:14px;color:#475569;border-bottom:1px solid #e2e8f0;">
                                        {{ $application_details->career?->title['en'] ?? '' }}
                                    </td>
                                </tr>

                                @if($application_details->message)
                                <tr>
                                    <td style="padding:14px;background:#f8fafc;font-weight:bold;color:#334155;">
                                        Message
                                    </td>
                                    <td style="padding:14px;color:#475569;line-height:1.6;">
                                        {{ $application_details->message }}
                                    </td>
                                </tr>
                                @endif

                            </table>

                            @if($application_details->cv_file)
                            <div style="margin-top:25px;text-align:center;">
                                <a href="{{ asset($application_details->cv_file) }}"
                                    target="_blank"
                                    style="display:inline-block;background:#2563eb;color:#ffffff;text-decoration:none;padding:12px 24px;border-radius:6px;font-weight:bold;">
                                    View / Download CV
                                </a>
                            </div>
                            @endif

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:25px;background:#f8fafc;border-top:1px solid #e2e8f0;text-align:center;">

                            <p style="margin:0;color:#64748b;font-size:13px;">
                                Submitted on
                                <strong>{{ now()->format('F d, Y h:i A') }}</strong>
                            </p>

                            <p style="margin:10px 0 0;color:#94a3b8;font-size:12px;">
                                This email was automatically generated by the website.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
