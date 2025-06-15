<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Instructor Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f8f9fa; }
        .footer { text-align: center; padding: 10px; color: #666; }
        .button { background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>🎓 New Instructor Request</h2>
    </div>

    <div class="content">
        <p>Hello,</p>

        <p>A new request to become an instructor has been submitted on the LMS platform.</p>

        <h3>📋 Request Details:</h3>
        <ul>
            <li><strong>User:</strong> {{ $instructorRequest->user->name }}</li>
            <li><strong>Email:</strong> {{ $instructorRequest->user->email }}</li>
            <li><strong>Submission Date:</strong> {{ $instructorRequest->created_at->format('d/m/Y at H:i') }}</li>
            <li><strong>CV:</strong> {{ $instructorRequest->cv_file ? 'Provided' : 'Not provided' }}</li>
        </ul>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ route('admin.instructor-requests.show', $instructorRequest) }}" class="button">
                Review Request
            </a>
        </p>

        <p><em>Please log in to the administration interface to review and process this request.</em></p>
    </div>

    <div class="footer">
        <p>Best regards,<br><strong>The {{ config('app.name') }} Team</strong></p>
    </div>
</div>
</body>
</html>
