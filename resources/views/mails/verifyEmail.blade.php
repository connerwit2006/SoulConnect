<!DOCTYPE html>
<html>
<head>
    <title>Bedankt voor het registreren!</title>
</head>
<body>
    <h1>Beste {{ $userName }},</h1>
    <p>Bedankt voor het registeren bij SoulConnect!</p>
    <p>We zouden je willen vragen om je email ook te verifiëren.</p>
    <p>Dat kan je doen door op de knop hier onder te drukken.</p>
    <a href="{{ $verificationUrl }}">Verifieer email</a>
</body>
</html>