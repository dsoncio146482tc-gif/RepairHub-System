<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 bg-gray-100 font-sans text-gray-800">
    <div class="mx-auto my-0 min-h-screen w-full max-w-5xl overflow-hidden bg-white shadow-none md:my-7 md:min-h-[calc(100vh-56px)] md:rounded-2xl md:shadow-xl">
        <div class="px-5 pt-6 md:px-9 md:pt-8">
            <h1 class="text-3xl font-bold">Home</h1>
            <div class="mt-2 mb-7 text-sm text-gray-500">Facility Issue Reporting System</div>
        </div>
        <div class="mx-5 mb-7 rounded-xl bg-red-800 p-6 text-white md:mx-9">
            <h2 class="mb-2 text-2xl font-semibold">Welcome to RepairHub</h2>
            <p class="mb-5 text-sm leading-6 md:text-base">A system for reporting and tracking campus facility issues.</p>
            <div class="flex gap-2.5">
                <button class="rounded-md bg-yellow-300 px-4 py-2 text-sm font-semibold text-gray-900">Report an Issue</button>
                <a href="#" class="rounded-md border border-white bg-white px-4 py-2 text-sm font-medium text-red-800">View Reports</a>
            </div>
        </div>
        <div class="mx-5 mb-8 grid gap-3.5 sm:grid-cols-2 lg:grid-cols-4 md:mx-9">
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold">3</div>
                <div class="mt-2 text-sm text-gray-500">Total Reports</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-red-800">1</div>
                <div class="mt-2 text-sm text-gray-500">Pending</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-amber-500">1</div>
                <div class="mt-2 text-sm text-gray-500">Ongoing</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-green-600">1</div>
                <div class="mt-2 text-sm text-gray-500">Resolved</div>
            </div>
        </div>
        <div class="mx-5 md:mx-9">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="text-2xl font-bold">Issues</h3>
                <a href="#" class="text-sm font-medium text-red-800">View all</a>
            </div>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full table-fixed border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200 text-left">
                            <th class="w-[22%] px-0 py-3 pl-4 text-base font-semibold text-gray-900 whitespace-nowrap">Object</th>
                            <th class="w-[43%] px-0 py-3 text-base font-semibold text-gray-900">Location</th>
                            <th class="w-[17%] px-0 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Status</th>
                            <th class="w-[18%] px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 pl-4 text-base font-semibold whitespace-nowrap">Chair</td>
                            <td class="py-3 text-[15px] text-gray-600">Room 301, Engineering Building</td>
                            <td class="py-3 text-base font-bold text-green-600 whitespace-nowrap">Resolved</td>
                            <td class="py-3 pr-4 text-[15px] text-gray-500 whitespace-nowrap">April 10, 2026</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 pl-4 text-base font-semibold whitespace-nowrap">Light</td>
                            <td class="py-3 text-[15px] text-gray-600">Hallway 2F, IT Building</td>
                            <td class="py-3 text-base font-bold text-amber-500 whitespace-nowrap">Ongoing</td>
                            <td class="py-3 pr-4 text-[15px] text-gray-500 whitespace-nowrap">February 3, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 pl-4 text-base font-semibold whitespace-nowrap">Window</td>
                            <td class="py-3 text-[15px] text-gray-600">DPT 213, New Building</td>
                            <td class="py-3 text-base font-bold text-red-800 whitespace-nowrap">Pending</td>
                            <td class="py-3 pr-4 text-[15px] text-gray-500 whitespace-nowrap">March 2, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mx-5 mt-6 mb-9 grid gap-3 sm:grid-cols-2 md:mx-9">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-3">
                <a href="#" class="flex items-center gap-3 font-medium text-red-800">
                    <span class="h-6 w-6 rounded-full bg-gray-200"></span>
                    <span>
                        <h4 class="text-sm font-semibold">Report an Issue</h4>
                        <p class="text-xs font-normal text-gray-500">Submit new report</p>
                    </span>
                </a>
            </div>
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-3">
                <a href="#" class="flex items-center gap-3 font-medium text-red-800">
                    <span class="h-6 w-6 rounded-full bg-gray-200"></span>
                    <span>
                        <h4 class="text-sm font-semibold">Admin Panel</h4>
                        <p class="text-xs font-normal text-gray-500">Manage reports</p>
                    </span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>