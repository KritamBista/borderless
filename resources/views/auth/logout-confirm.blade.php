<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Confirm Logout</title>
</head>
<body class="bg-[#0b0f14] text-white">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-[#0f1621] border border-white/10 rounded-3xl p-8 w-full max-w-md text-center">

        <h1 class="text-2xl font-extrabold mb-4">
            Are you sure?
        </h1>

        <p class="text-gray-400 text-sm mb-6">
            Do you want to logout from your account?
        </p>

        <div class="flex gap-4">

            <a href="{{ url()->previous() }}"
               class="w-full border border-white/20 py-3 rounded-2xl hover:bg-white/5 transition">
                No
            </a>

            <form method="POST" action="{{ route('logout.perform') }}" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full bg-[#d6b15e] text-black font-bold py-3 rounded-2xl hover:shadow-lg transition">
                    Yes, Logout
                </button>
            </form>

        </div>

    </div>
</div>

</body>
</html>
