<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'RepairHub') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 px-4 py-10 font-sans text-slate-900">
    <div class="mx-auto w-full max-w-3xl rounded-2xl bg-white p-8 shadow-lg">
        <h1 class="text-3xl font-bold">RepairHub System</h1>
        <p class="mt-2 text-slate-600">Facility Issue Reporting System</p>

        <div class="mt-8 grid gap-3 sm:grid-cols-2">
            <a href="{{ url('/dashboard') }}" class="rounded-lg bg-red-700 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-red-800">Home Dashboard</a>
            <a href="{{ url('/admin-dashboard') }}" class="rounded-lg bg-slate-800 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-slate-900">Admin Dashboard</a>
            <a href="{{ url('/report-issue') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-800 transition hover:bg-slate-50">Report Issue</a>
            <a href="{{ url('/register') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-800 transition hover:bg-slate-50">Register</a>
        </div>
    </div>
</body>
</html>
