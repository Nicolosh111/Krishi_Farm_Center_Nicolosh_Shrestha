<!DOCTYPE html>
<html>
<head>
    <title>Expert Approval</title>
</head>
<body>
    <h2>Hello {{ $expert->name }},</h2>
    <p>Congratulations! Your expert account has been approved on Krishi Center.</p>
    <p>You can now log in and start helping farmers with consultations.</p>

    <!-- Login Button -->
    <p>
        <a href="{{ route('login') }}"
           style="display:inline-block; padding:10px 20px; background-color:#28a745; color:#fff; text-decoration:none; border-radius:5px;">
            Login Now
        </a>
    </p>

    <p>Best regards,<br>Krishi Center Team</p>
</body>
</html>
