<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in with Google</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-50 px-4 font-sans">
    <div class="w-full max-w-md rounded-xl bg-white p-6 text-center shadow-md">
        <div class="mb-4 text-left">
            <a href="{{ route('login') }}" class="text-sm font-semibold text-red-700 hover:underline">&larr; Back to login</a>
        </div>

        <div class="mb-6 text-center">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="mx-auto mb-4 w-12" alt="Google logo">
            <h1 class="text-2xl font-semibold text-gray-900">Sign in with Google</h1>
            <p class="text-sm text-gray-500">Enter the email and password for your Google account to continue.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-3 text-left text-sm text-red-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.google.submit') }}" method="POST" class="space-y-4 text-left">
            @csrf

            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">Email Address</label>
                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100" placeholder="Enter your email address">
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100" placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full rounded-xl bg-red-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-800">
                Continue
            </button>
        </form>

        <p class="mt-5 text-sm text-gray-500">This is a simulated Google sign-in flow for the app. Your credentials are used to sign you into RepairHub.</p>
    </div>
</body>
</html>
