<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Report - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --nav-drawer-width: min(18rem, 88vw); }
        #side-nav { width: var(--nav-drawer-width); }
        #my-report-shell {
            transition: margin 0.2s ease-out, width 0.2s ease-out, max-width 0.2s ease-out, border-radius 0.2s ease-out;
        }
        #my-report-shell.nav-open {
            margin-left: var(--nav-drawer-width);
            margin-right: 0;
            max-width: none;
            width: calc(100vw - var(--nav-drawer-width));
            width: calc(100dvw - var(--nav-drawer-width));
            border-radius: 0;
        }
    </style>
</head>
<body class="m-0 min-h-dvh bg-gray-100 font-sans text-gray-900">
    <div id="nav-overlay" class="fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 md:bg-black/30" aria-hidden="true" onclick="closeSideNav()"></div>

    <aside id="side-nav" class="fixed top-0 left-0 z-50 flex h-full -translate-x-full flex-col border-r border-red-950/40 bg-[#6b0f1a] shadow-xl transition-transform duration-200 ease-out" aria-label="Main menu">
        <div class="flex shrink-0 items-start justify-between border-b border-white/15 px-5 py-4 md:px-6">
            <div>
                <span class="block text-xl font-bold leading-none text-white sm:text-2xl">RepairHub</span>
                <span class="mt-1 block text-xs text-white/75">Facility Issue Reporting System</span>
            </div>
            <button type="button" onclick="closeSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-xl leading-none text-white/80 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Close menu">
                &times;
            </button>
        </div>
        <nav class="flex flex-1 flex-col gap-0.5 p-3">
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Home</a>
            <a href="{{ route('report_issue') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Report Issue</a>
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">My Report</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log in</a>
        </nav>
    </aside>

    <div id="my-report-shell" class="relative z-10 mx-auto my-8 w-full max-w-xl overflow-hidden rounded-xl bg-white shadow-md">
        <header class="flex h-16 shrink-0 items-center border-b border-white/15 bg-red-800 px-4">
            <button type="button" id="nav-menu-btn" onclick="openSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-2xl leading-none text-white/90 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-expanded="false" aria-controls="side-nav" aria-label="Open menu">
                &#9776;
            </button>
            <h1 class="ml-3 text-xl font-bold leading-none text-white">My Report</h1>
        </header>

        <main class="flex-1 bg-gray-100 p-4">
            <section class="mb-3">
                <label class="mb-2 block text-lg font-semibold text-gray-900">Search by Name:</label>
                <div class="flex items-center gap-2 rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5">
                    <span class="text-lg text-gray-600">👤</span>
                    <input type="text" placeholder="Enter reporter name.." class="w-full bg-transparent text-sm text-gray-900 outline-none placeholder:text-gray-500">
                </div>
            </section>

            <section class="mb-3">
                <label class="mb-2 block text-lg font-semibold text-gray-900">Filter by Status:</label>
                <div class="flex items-center justify-between rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm text-gray-800">
                    <span>⚐ All Statuses</span>
                    <span class="text-lg text-gray-500">⌄</span>
                </div>
            </section>

            <section class="space-y-3">
                <article class="rounded-xl bg-gray-50 p-4">
                    <div class="mb-1 flex items-start justify-between gap-3">
                        <h2 class="text-xl font-semibold text-gray-900">Chair</h2>
                        <div class="text-right">
                            <p class="text-base font-medium text-green-600">Resolved on: April 12, 2026, 3:00 PM</p>
                        </div>
                    </div>
                    <div class="space-y-1 text-base text-gray-800">
                        <p><span class="font-medium text-gray-700">Location:</span> Room 301, Engineering Building</p>
                        <p><span class="font-medium text-gray-700">ID:</span> 123456</p>
                        <p><span class="font-medium text-gray-700">Date:</span> April 10, 2026, 1:33 PM</p>
                        <p><span class="font-medium text-gray-700">Priority Level:</span> <span class="text-gray-800">High</span></p>
                    </div>
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-base font-medium text-gray-700">Description:</p>
                    </div>
                    <p class="text-base text-gray-800">Broken leg chair, unsafe to use</p>
                    <div class="mt-2 flex justify-end gap-2">
                        <button class="rounded-lg bg-blue-700 px-3 py-1.5 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-1.5 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="rounded-xl bg-gray-50 p-4">
                    <div class="mb-1 flex items-start justify-between gap-3">
                        <h2 class="text-xl font-semibold text-gray-900">Light</h2>
                        <p class="text-base font-medium text-indigo-500">Ongoing</p>
                    </div>
                    <div class="space-y-1 text-base text-gray-800">
                        <p><span class="font-medium text-gray-700">Location:</span> Hallway 2F, IT Building</p>
                        <p><span class="font-medium text-gray-700">ID:</span> 112345</p>
                        <p><span class="font-medium text-gray-700">Date:</span> February 3, 2026, 8:07 AM</p>
                        <p><span class="font-medium text-gray-700">Priority Level:</span> <span class="text-gray-800">Medium</span></p>
                    </div>
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-base font-medium text-gray-700">Description:</p>
                    </div>
                    <p class="text-base text-gray-800">Flickering fluorescent light</p>
                    <div class="mt-2 flex justify-end gap-2">
                        <button class="rounded-lg bg-blue-700 px-3 py-1.5 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-1.5 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="rounded-xl bg-gray-50 p-4">
                    <div class="mb-1 flex items-start justify-between gap-3">
                        <h2 class="text-xl font-semibold text-gray-900">Window</h2>
                        <p class="text-base font-medium text-amber-500">Pending</p>
                    </div>
                    <div class="space-y-1 text-base text-gray-800">
                        <p><span class="font-medium text-gray-700">Location:</span> DPT 213, New Building</p>
                        <p><span class="font-medium text-gray-700">Fullname:</span> Juan Dela Cruz</p>
                        <p><span class="font-medium text-gray-700">Date:</span> March 2, 2026, 10:27 AM</p>
                        <p><span class="font-medium text-gray-700">Priority Level:</span> <span class="text-gray-800">Medium</span></p>
                    </div>
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-base font-medium text-gray-700">Description:</p>
                    </div>
                    <p class="text-base text-gray-800">Window latch broken, cannot close properly</p>
                    <div class="mt-2 flex justify-end gap-2">
                        <button class="rounded-lg bg-blue-700 px-3 py-1.5 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-1.5 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>
            </section>
        </main>
    </div>

    <script>
        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('my-report-shell').classList.add('nav-open');
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.setAttribute('aria-hidden', 'false');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('my-report-shell').classList.remove('nav-open');
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100');
            overlay.setAttribute('aria-hidden', 'true');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSideNav();
        });
    </script>
</body>
</html>
