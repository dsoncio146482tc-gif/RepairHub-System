<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 bg-gray-100 font-sans text-gray-900">
    <div class="mx-auto my-0 min-h-screen w-full max-w-6xl overflow-hidden bg-white shadow-none md:my-7 md:min-h-[calc(100vh-56px)] md:rounded-2xl md:shadow-xl">
        <header class="flex items-center justify-between border-b border-gray-200 px-5 py-4 md:px-7">
            <div class="text-2xl text-gray-500">&#9776;</div>
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <div></div>
        </header>

        <main class="px-5 py-6 md:px-7 md:pb-8">
            <section class="mb-6 grid gap-3.5 sm:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-xl border border-gray-200 bg-gray-50 p-3.5">
                    <div class="mb-2 text-3xl leading-none font-bold">3</div>
                    <div class="text-sm text-gray-500">Total Reports</div>
                </article>
                <article class="rounded-xl border border-gray-200 bg-gray-50 p-3.5">
                    <div class="mb-2 text-3xl leading-none font-bold text-rose-700">1</div>
                    <div class="text-sm text-gray-500">Pending</div>
                </article>
                <article class="rounded-xl border border-gray-200 bg-gray-50 p-3.5">
                    <div class="mb-2 text-3xl leading-none font-bold text-amber-600">1</div>
                    <div class="text-sm text-gray-500">Ongoing</div>
                </article>
                <article class="rounded-xl border border-gray-200 bg-gray-50 p-3.5">
                    <div class="mb-2 text-3xl leading-none font-bold text-green-600">1</div>
                    <div class="text-sm text-gray-500">Resolved</div>
                </article>
            </section>

            <section class="mb-4 flex items-center gap-2.5">
                <label for="status-filter" class="text-sm text-gray-700">Filter by Status:</label>
                <select id="status-filter" class="rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>Ongoing</option>
                    <option>Resolved</option>
                </select>
            </section>

            <section class="grid gap-3">
                <article class="rounded-xl border border-gray-200 bg-white px-5 pt-4 pb-3">
                    <div class="mb-3 flex flex-col items-start justify-between gap-2 sm:flex-row sm:items-center">
                        <h2 class="text-[26px] leading-tight font-bold">Chair</h2>
                        <span class="text-sm font-semibold text-green-600">Resolved on: April 12, 2026, 3:00 PM</span>
                    </div>
                    <div class="mb-3 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-2 text-[14px] leading-[1.35] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> Room 301, Engineering Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">ID:</span> 123456</div>
                        <div><span class="font-semibold text-[#102842]">Priority:</span> High</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> April 10, 2026, 1:33 PM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-1 text-sm font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2.5 text-[15px] text-[#1f3552]">Broken leg chair, unsafe to use</div>
                    <div class="mt-3 flex justify-start gap-2 border-t border-gray-100 pt-2.5 sm:justify-end">
                        <button class="rounded-lg bg-rose-800 px-3 py-2 text-xs font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-rose-700 px-3 py-2 text-xs font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="rounded-xl border border-gray-200 bg-white px-5 pt-4 pb-3">
                    <div class="mb-3 flex flex-col items-start justify-between gap-2 sm:flex-row sm:items-center">
                        <h2 class="text-[26px] leading-tight font-bold">Light</h2>
                        <span class="text-sm font-semibold text-amber-600">Ongoing</span>
                    </div>
                    <div class="mb-3 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-2 text-[14px] leading-[1.35] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> Hallway 2F, IT Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">ID:</span> 112345</div>
                        <div><span class="font-semibold text-[#102842]">Priority:</span> Medium</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> February 3, 2026, 8:07 AM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-1 text-sm font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2.5 text-[15px] text-[#1f3552]">Flickering fluorescent light</div>
                    <div class="mt-3 flex justify-start gap-2 border-t border-gray-100 pt-2.5 sm:justify-end">
                        <button class="rounded-lg bg-rose-800 px-3 py-2 text-xs font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-rose-700 px-3 py-2 text-xs font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="rounded-xl border border-gray-200 bg-white px-5 pt-4 pb-3">
                    <div class="mb-3 flex flex-col items-start justify-between gap-2 sm:flex-row sm:items-center">
                        <h2 class="text-[26px] leading-tight font-bold">Window</h2>
                        <span class="text-sm font-semibold text-red-500">Pending</span>
                    </div>
                    <div class="mb-3 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-2 text-[14px] leading-[1.35] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> DPT 213, New Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">ID:</span> Juan Dela Cruz</div>
                        <div><span class="font-semibold text-[#102842]">Priority:</span> Medium</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> March 2, 2026, 10:27 AM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-1 text-sm font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2.5 text-[15px] text-[#1f3552]">Window latch broken, cannot close properly</div>
                    <div class="mt-3 flex justify-start gap-2 border-t border-gray-100 pt-2.5 sm:justify-end">
                        <button class="rounded-lg bg-rose-800 px-3 py-2 text-xs font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-rose-700 px-3 py-2 text-xs font-semibold text-white">Delete</button>
                    </div>
                </article>
            </section>
        </main>
    </div>
</body>
</html>
