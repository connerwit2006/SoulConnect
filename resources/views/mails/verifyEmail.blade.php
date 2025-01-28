<!DOCTYPE html>
<html>
<head>
    <title>Bedankt voor het registreren!</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-pink-500 text-white text-center py-6">
            <h1 class="text-2xl font-semibold">Bedankt voor het registreren!</h1>
        </div>
        <!-- Body -->
        <div class="p-6">
            <p class="text-lg text-gray-800">Beste <strong class="font-semibold">{{ $userName }}</strong>,</p>
            <p class="mt-4 text-gray-700">
                Bedankt voor het registreren bij <strong>SoulConnect</strong>! We zijn blij dat je er bent.
            </p>
            <p class="mt-4 text-gray-700">
                Om je registratie te voltooien, vragen we je om je e-mailadres te verifiëren. Klik op de onderstaande knop om dit te doen:
            </p>
            <!-- Verification Button -->
            <div class="text-center mt-6">
                <a href="{{ $verificationUrl }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold text-lg py-3 px-8 rounded-lg shadow-md transition">
                    Verifieer Email
                </a>
            </div>
            <p class="mt-6 text-gray-500 text-sm">
                Als je deze e-mail niet hebt aangevraagd, kun je deze negeren.
            </p>
        </div>
        <!-- Footer -->
        <div class="bg-gray-100 text-center py-4">
            <p class="text-sm text-gray-500">Met vriendelijke groet,<br>Het SoulConnect Team</p>
        </div>
    </div>
</body>
</html>
