<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appraisal Assignment Reminder Notification</title>
</head>
<body>

    {{-- @php echo "<pre>";print_r($manager_id);die; @endphp --}}
    <h2>Hello, {{ ucfirst($maildata->user?->name) }}</h2>

    <p>We are pleased to inform you that a new goal has been assigned to you for review. Below are the details of the assigned goal:</p>
    
    <h3>Appraisal Details:</h3>
    {{-- <p><strong>Questionnaire:</strong> {{ ucfirst($maildata->name) }}  </p> --}}
    <p><strong>Review cycle:</strong>  {{ ucfirst($maildata->reviewCycle?->title) }} </p>
    <p><strong>Self Deadline Date:</strong> {{ ucfirst($maildata->self_review_deadline) }}  </p>

    <p>Please ensure that you review and take the necessary actions before the due date.</p>

    <p>If you have any questions, feel free to reach out to your administrator or manager.</p>

    <p>Thank you for your dedication and commitment!</p>

    <p>Best Regards,</p>
    <p><strong>The Admin Team</strong></p>
</body>
</html>
