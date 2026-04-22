<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 bg-gray-50 font-sans">
    <div class="mx-auto my-8 w-full max-w-xl rounded-xl bg-white p-6 shadow-md">
        <h1 class="mb-5 text-center text-3xl font-bold text-gray-900">Report Issue</h1>
        <form action="/submit-issue" method="POST">
            <label for="facility-type" class="mb-2 block text-sm font-semibold text-gray-800">Facility Type *</label>
            <select id="facility-type" name="facility_type" required class="mb-4 w-full appearance-none rounded-md border border-gray-300 bg-white bg-[url('{{ asset('images/camera-icon.png') }}')] bg-[length:22px_22px] bg-[right_10px_center] bg-no-repeat px-3 py-2.5 pr-10 text-sm text-gray-700 outline-none transition focus:border-red-700 focus:ring-2 focus:ring-red-100">
                <option value="" disabled selected>Select Facility Type</option>
                <option value="electrical">Electrical</option>
                <option value="plumbing">Plumbing</option>
                <option value="structural">Structural</option>
            </select>

            <label for="full-name" class="mb-2 block text-sm font-semibold text-gray-800">Full Name</label>
            <input type="text" id="full-name" name="full_name" placeholder="(Optional)" class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-red-700 focus:ring-2 focus:ring-red-100">

            <label for="location" class="mb-2 block text-sm font-semibold text-gray-800">Location *</label>
            <input type="text" id="location" name="location" placeholder="e.g., Room 301, Engineering Bldg." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-red-700 focus:ring-2 focus:ring-red-100">

            <label for="description" class="mb-2 block text-sm font-semibold text-gray-800">Description *</label>
            <textarea id="description" name="description" placeholder="Describe the issue in detail..." required class="mb-4 min-h-28 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-red-700 focus:ring-2 focus:ring-red-100"></textarea>

            <label class="mb-2 block text-sm font-semibold text-gray-800">Priority Level *</label>
            <div class="mb-4 flex gap-2">
                <button type="button" class="w-1/3 rounded-md bg-green-100 px-2 py-2 text-center text-sm font-medium text-green-800">Low<br>Minor Issue</button>
                <button type="button" class="w-1/3 rounded-md bg-yellow-100 px-2 py-2 text-center text-sm font-medium text-yellow-800">Medium<br>Affects Use</button>
                <button type="button" class="w-1/3 rounded-md bg-red-100 px-2 py-2 text-center text-sm font-medium text-red-800">High<br>Urgent/Safety</button>
            </div>

            <label for="id-number" class="mb-2 block text-sm font-semibold text-gray-800">Your ID Number *</label>
            <input type="text" id="id-number" name="id_number" placeholder="Enter your ID number" required class="mb-5 w-full rounded-md border border-gray-300 px-3 py-2.5 text-sm text-gray-700 outline-none transition focus:border-red-700 focus:ring-2 focus:ring-red-100">

            <div class="flex flex-col items-center gap-3">
                <button type="submit" class="w-full max-w-xs rounded-md bg-red-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-800">Submit</button>
                <button type="button" class="w-full max-w-xs rounded-md border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-200">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>