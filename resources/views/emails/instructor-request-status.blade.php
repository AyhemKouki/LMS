<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Response to Your Instructor Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { color: white; padding: 20px; text-align: center; }
        .header.approved { background-color: #28a745; }
        .header.rejected { background-color: #dc3545; }
        .content { padding: 20px; background-color: #f8f9fa; }
        .footer { text-align: center; padding: 10px; color: #666; }
        .status-badge { padding: 10px 20px; border-radius: 5px; font-weight: bold; display: inline-block; margin: 10px 0; }
        .status-approved { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .notes { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header {{ $instructorRequest->status }}">
        <h2>
            @if($instructorRequest->status === 'approved')
                🎉 Instructor Request Approved!
            @else
                📝 Response to Your Instructor Request
            @endif
        </h2>
    </div>

    <div class="content">
        <p>Hello <strong>{{ $instructorRequest->user->name }}</strong>,</p>

        @if($instructorRequest->status === 'approved')
            <div class="status-badge status-approved">✅ APPROVED</div>
            <p>Congratulations! Your request to become an instructor has been <strong>approved</strong>.</p>
            <p>🎓 You can now:</p>
            <ul>
                <li>Create and manage courses on our platform</li>
                <li>Interact with students</li>
                <li>Access instructor tools</li>
            </ul>
            <p>Welcome to the instructor team!</p>
        @else
            <div class="status-badge status-rejected">❌ REJECTED</div>
            <p>Thank you for your interest in becoming an instructor on our platform.</p>
            <p>After review, unfortunately your request could not be accepted at this time.</p>
        @endif

        @if($instructorRequest->admin_notes)
            <div class="notes">
                <h4>💬 Team Message:</h4>
                <p>{{ $instructorRequest->admin_notes }}</p>
            </div>
        @endif

        <p>If you have any questions about this decision, please don't hesitate to contact us.</p>
    </div>

    <div class="footer">
        <p>Best regards,<br><strong>The {{ config('app.name') }} Team</strong></p>
        <p><small>Processing date: {{ $instructorRequest->reviewed_at->format('m/d/Y at H:i') }}</small></p>
    </div>
</div>
</body>
</html>
