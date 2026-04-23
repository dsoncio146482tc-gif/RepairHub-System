<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --nav-drawer-width: min(18rem, 88vw); }
        #side-nav { width: var(--nav-drawer-width); }
        #dashboard-main-shell {
            transition: margin 0.2s ease-out, width 0.2s ease-out, max-width 0.2s ease-out, border-radius 0.2s ease-out;
        }
        #dashboard-main-shell.dashboard-layout-nav-open {
            margin-left: var(--nav-drawer-width);
            margin-right: 0;
            max-width: none;
            width: calc(100vw - var(--nav-drawer-width));
            width: calc(100dvw - var(--nav-drawer-width));
            border-radius: 0;
        }
    </style>
</head>
<body class="m-0 min-h-dvh bg-gray-100 font-sans text-gray-800">
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
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">Home</a>
            <a href="{{ route('report_issue') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Report Issue</a>
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">My Report</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log in</a>
        </nav>
    </aside>

    <div id="dashboard-main-shell" class="relative z-10 mx-auto flex min-h-dvh w-full max-w-5xl flex-col overflow-hidden bg-white shadow-none md:rounded-2xl md:shadow-xl">
        <header class="shrink-0 border-b border-gray-200 bg-white px-5 py-4 md:px-9">
            <div class="flex items-start gap-2.5">
                <button type="button" id="nav-menu-btn" onclick="openSideNav()" class="mt-1 flex size-8 shrink-0 items-center justify-center rounded-md text-lg leading-none text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-200" aria-expanded="false" aria-controls="side-nav" aria-label="Open menu">
                    &#9776;
                </button>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Home</h1>
                    <div class="mt-1.5 text-sm text-gray-500">Facility Issue Reporting System</div>
                </div>
            </div>
        </header>
        <div class="px-5 pt-2 md:px-9">
        <div class="mb-7 rounded-xl bg-red-800 p-6 text-white">
            <h2 class="mb-2 text-2xl font-semibold">Welcome to RepairHub</h2>
            <p class="mb-5 text-sm leading-6 md:text-base">A system for reporting and tracking campus facility issues.</p>
            <div class="flex gap-2.5">
              <a href="{{ route('report_issue') }}" class="rounded-md bg-yellow-300 px-4 py-2 text-sm font-semibold text-gray-900">Report an Issue</a>
              <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-white bg-white px-4 py-2 text-sm font-medium text-red-800">View Reports</a>
            </div>
        </div>
        <div class="mb-8 grid gap-3.5 sm:grid-cols-2 lg:grid-cols-4">
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
        <div>
            <div class="mb-3 flex items-center justify-between">
                <h3 class="text-2xl font-bold">Issues</h3>
                <a href="#" class="text-sm font-medium text-red-800">View all</a>
            </div>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200 text-left">
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Object</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900">Location</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Priority Level</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Status</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3 text-base font-semibold whitespace-nowrap">Chair</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600">Room 301, Engineering Building</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600 whitespace-nowrap">High</td>
                            <td class="px-4 py-3 text-base font-bold text-green-600 whitespace-nowrap">Resolved</td>
                            <td class="px-4 py-3 text-[15px] text-gray-500 whitespace-nowrap">April 10, 2026</td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3 text-base font-semibold whitespace-nowrap">Light</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600">Hallway 2F, IT Building</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600 whitespace-nowrap">Medium</td>
                            <td class="px-4 py-3 text-base font-bold text-blue-600 whitespace-nowrap">Ongoing</td>
                            <td class="px-4 py-3 text-[15px] text-gray-500 whitespace-nowrap">February 3, 2026</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-base font-semibold whitespace-nowrap">Window</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600">DPT 213, New Building</td>
                            <td class="px-4 py-3 text-[15px] text-gray-600 whitespace-nowrap">Medium</td>
                            <td class="px-4 py-3 text-base font-bold text-red-800 whitespace-nowrap">Pending</td>
                            <td class="px-4 py-3 text-[15px] text-gray-500 whitespace-nowrap">March 2, 2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6 mb-9 grid w-full gap-3 sm:grid-cols-2">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-3">
                <a href="{{ route('report_issue') }}" class="flex w-full items-center gap-3 font-medium text-red-800">
                    <span class="min-w-0 flex-1">
                        <h4 class="text-sm font-semibold">Report an Issue</h4>
                        <p class="text-xs font-normal text-gray-500">Submit new report</p>
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-red-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-3">
                <a href="{{ route('admin.dashboard') }}" class="flex w-full items-center gap-3 font-medium text-red-800">
                    <span class="min-w-0 flex-1">
                        <h4 class="text-sm font-semibold">Admin Dashboard</h4>
                        <p class="text-xs font-normal text-gray-500">Manage reports</p>
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-red-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        </div>
    </div>

    <script>
        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('dashboard-main-shell').classList.add('dashboard-layout-nav-open');
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.setAttribute('aria-hidden', 'false');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }
        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('dashboard-main-shell').classList.remove('dashboard-layout-nav-open');
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
