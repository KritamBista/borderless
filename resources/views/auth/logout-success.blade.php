<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Logout Successful</title>
</head>

<body class="bg-[#0b0f14] text-white">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-[#0f1621] border border-white/10 rounded-3xl p-8 w-full max-w-md text-center">

            <h1 class="text-2xl font-extrabold mb-2">
                Logout Successful
            </h1>

            <p class="text-gray-400 text-sm mb-6">
                You have been logged out successfully.
            </p>

            <a href="{{ url('/') }}"
                class="inline-block bg-[#d6b15e] text-black font-bold px-6 py-3 rounded-2xl hover:shadow-lg transition">
                Back to Home
            </a>

        </div>
    </div>

</body>

</html>
