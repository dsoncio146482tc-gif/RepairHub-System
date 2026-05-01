<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RepairHub - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-50 px-4 font-sans">
    <div class="w-full max-w-md rounded-xl bg-white p-6 text-center text-gray-900 shadow-lg shadow-gray-200/70">
        <img src="{{ asset('images/um logo.jpg') }}" alt="Logo" class="mx-auto mb-5 w-28">
        <div class="mb-2 text-3xl font-bold text-gray-900">RepairHub</div>
        <div class="mb-5 text-sm font-medium tracking-wide text-gray-500">VISAYAN CAMPUS</div>
        
        <h2 class="mb-2 text-xl font-semibold text-gray-900">Sign in to your account</h2>
        <p class="mb-5 text-sm text-gray-500">Enter your credentials to access your account</p>

        @if ($errors->any())
            <div class="mb-4 rounded-md bg-yellow-50 p-3 text-left text-xs text-red-700 font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="text-left mb-4">
                <label class="text-xs font-semibold text-gray-600 uppercase">Email Address</label>
                <input type="email" name="email" required 
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100" 
                    placeholder="email@umindanao.edu.ph" value="{{ old('email') }}">
            </div>

            <div class="text-left mb-5">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <a href="#" class="text-[10px] text-red-600 hover:underline">Forgot password?</a>
                </div>
                <input type="password" name="password" required 
                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100" 
                    placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full rounded-md bg-red-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-800">
                Sign In
            </button>
        </form>

        <div class="my-5 text-sm text-gray-500">or</div>
        
        <a href="{{ route('login.google') }}" class="flex items-center justify-center mb-3 w-full rounded-md border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="mr-2 w-4">
            Sign in with Google
        </a>

        <p class="mt-5 text-xs text-gray-500 text-center">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-bold text-red-700 hover:underline">Create an account</a>
        </p>
    </div>
</body>
</html>