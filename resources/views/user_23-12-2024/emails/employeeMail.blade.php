<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Performance Appraisal Feedback</title>
</head>
<body>
    <h3>Performance Appraisal Feedback</h3>

    <p>Dear {{ $data->User->name }},</p>

    <p>I hope this email finds you well.</p>

    <p>
        Thank you for your contributions and efforts over the past review period. After careful consideration of your performance appraisal, I would like to share some feedback with you.
    </p>
    <p>
        To check your feedback, <a href="{{$route}}">click here</a>.
    </p>

    <p>
        Your hard work and dedication have been instrumental in achieving our team’s goals. We believe that by focusing on the areas for improvement, you can continue to grow and excel in your role.
    </p>

    <p>Best regards,</p>

    <p>{{ $data->Manager->name }}</p>
    <p>WorkMate</p>
</body>
</html>
