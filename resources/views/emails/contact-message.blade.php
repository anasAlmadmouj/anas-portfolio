<!doctype html>
<html>
<body style="font-family: sans-serif; color: #1a1815; line-height: 1.6;">
    <p><strong>New message from the portfolio contact form</strong></p>

    <p><strong>Name:</strong> {{ $senderName }}<br>
    <strong>Email:</strong> {{ $senderEmail }}</p>

    <p><strong>Message:</strong></p>
    <p>{{ $messageBody }}</p>
</body>
</html>
