<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Hub - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-8 font-sans sm:py-12">
    <div class="w-full max-w-md rounded-xl bg-white p-5 text-center shadow-md sm:p-6">
        <img src="{{ asset('images/um logo.jpg') }}" alt="Logo" class="mx-auto mb-5 w-28">
        <div class="mb-2 text-3xl font-bold text-gray-900">Repair Hub</div>
        <div class="mb-5 text-sm font-medium tracking-wide text-gray-500">VISAYAN CAMPUS</div>
        
        <h2 class="mb-2 text-2xl font-semibold text-gray-900">Create an account</h2>
        <p class="mb-5 text-sm text-gray-600">Enter your details to sign up</p>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="text-left mb-4">
                <label class="text-xs font-semibold text-gray-600 uppercase">Email Address</label>
                <input type="email" name="email" required 
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100" 
                    placeholder="email@umindanao.edu.ph">
            </div>

            <div class="text-left mb-5">
                <label class="text-xs font-semibold text-gray-600 uppercase">Password</label>
                <input type="password" name="password" required 
                    class="mt-1 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-red-700 focus:ring-2 focus:ring-red-100">
            </div>

            <button type="submit" class="mt-4 w-full rounded-md bg-red-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-800">
                Continue
            </button>
        </form>

        <div class="my-5 text-sm text-gray-500">or</div>
        
        <button class="mb-3 w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 flex items-center justify-center">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="mr-2 w-4">
            Continue with Google
        </button>

        <p class="mt-4 text-sm text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-red-700 hover:underline">Log in</a>
        </p>
       
        <p class="mt-6 text-xs text-gray-500">By clicking continue, you agree to our <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a></p>
    </div>
</body>
</html>