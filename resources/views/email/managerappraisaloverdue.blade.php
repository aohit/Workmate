<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appraisal Assignment Overdue Notification</title>
</head>
<body>

    <h2>Hello {{ ucfirst($maildata->Manager?->name) }}</h2>

    <p>We would like to inform you that an appraisal review for one of your team members has been assigned to you. Below are the details of the assignment:</p>
    
    <h3>Review Details:</h3>
    <p><strong>Team Member:</strong> {{ ucfirst($maildata->User?->name) }}</p>
    <p><strong>Review Cycle:</strong> {{ ucfirst($maildata->reviewcycle?->title) }}</p>
    <p><strong>Self-Assessment Deadline:(Employee)</strong> {{ $maildata->self_review_deadline }}</p>
    <p><strong>Manager Review Deadline:</strong> {{ $maildata->manager_review_deadlin }}</p>

    <p>Please review the appraisal and provide your feedback before the due date.</p>

    <p>If you have any questions, feel free to reach out to the HR department or the system administrator.</p>

    <p>Thank you for your continued support and leadership!</p>

    <p>Best Regards,</p>
    <p><strong>The Admin Team</strong></p>
</body>
</html>
