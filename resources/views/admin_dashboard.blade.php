<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --admin-nav-drawer-width: min(18rem, 88vw); }
        #side-nav { width: var(--admin-nav-drawer-width); }
        /* Opening the drawer used to use translateX on a centered card, which left a grey strip between the maroon panel and the white shell. */
        #admin-main-shell {
            transition: margin 0.2s ease-out, width 0.2s ease-out, max-width 0.2s ease-out, border-radius 0.2s ease-out;
        }
        #admin-main-shell.admin-layout-nav-open {
            margin-left: var(--admin-nav-drawer-width);
            margin-right: 0;
            max-width: none;
            width: calc(100vw - var(--admin-nav-drawer-width));
            width: calc(100dvw - var(--admin-nav-drawer-width));
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
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">My Report</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log in</a>
        </nav>
    </aside>

    <div id="admin-main-shell" class="relative z-10 mx-auto flex min-h-dvh w-full max-w-6xl flex-col overflow-hidden bg-white shadow-none md:rounded-2xl md:shadow-xl">
        <header class="flex h-16 shrink-0 items-center gap-2.5 border-b border-white/15 bg-red-800 px-4 md:px-6">
            <button type="button" id="nav-menu-btn" onclick="openSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-lg leading-none text-white/90 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-expanded="false" aria-controls="side-nav" aria-label="Open menu">
                &#9776;
            </button>
            <h1 class="text-2xl font-bold leading-none tracking-tight text-white">Admin Dashboard</h1>
        </header>

        <main class="flex flex-1 flex-col px-5 py-6 md:px-7 md:pb-8">
            <section class="mx-auto mb-5 flex flex-wrap justify-center gap-2.5">
                <article class="w-44 flex-none rounded-xl border border-gray-200 bg-gray-50 px-3 py-3">
                    <div class="mb-2 text-3xl leading-none font-bold">3</div>
                    <div class="text-sm text-gray-500">Total Reports</div>
                </article>
                <article class="w-44 flex-none rounded-xl border border-gray-200 bg-gray-50 px-3 py-3">
                    <div class="mb-2 text-3xl leading-none font-bold text-rose-700">1</div>
                    <div class="text-sm text-gray-500">Pending</div>
                </article>
                <article class="w-44 flex-none rounded-xl border border-gray-200 bg-gray-50 px-3 py-3">
                    <div class="mb-2 text-3xl leading-none font-bold text-amber-600">1</div>
                    <div class="text-sm text-gray-500">Ongoing</div>
                </article>
                <article class="w-44 flex-none rounded-xl border border-gray-200 bg-gray-50 px-3 py-3">
                    <div class="mb-2 text-3xl leading-none font-bold text-green-600">1</div>
                    <div class="text-sm text-gray-500">Resolved</div>
                </article>
            </section>

            <section class="mb-4 flex items-center gap-2.5 pl-4 md:pl-6">
                <label for="status-filter" class="text-sm text-gray-700">Filter by Status:</label>
                <select id="status-filter" class="rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>Ongoing</option>
                    <option>Resolved</option>
                </select>
            </section>

            <section class="grid gap-2.5">
                <article class="mx-auto w-full max-w-4xl rounded-xl border border-gray-200 bg-white px-6 pt-4 pb-3">
                    <div class="mb-2.5 flex flex-col items-start justify-between gap-1.5 sm:flex-row sm:items-start">
                        <h2 class="text-[26px] leading-tight font-bold">Chair</h2>
                        <div class="text-left sm:text-right">
                            <span class="block text-lg font-semibold text-green-600">Resolved on: April 12, 2026, 3:00 PM</span>
                            <span class="mt-1 block text-base text-[#1f3552]"><span class="font-semibold text-[#102842]">Priority:</span> High</span>
                        </div>
                    </div>
                    <div class="mb-2.5 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-1.5 text-base leading-[1.4] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> Room 301, Engineering Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">ID:</span> 123456</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> April 10, 2026, 1:33 PM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-0.5 text-[17px] font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2 text-[17px] text-[#1f3552]">Broken leg chair, unsafe to use</div>
                    <div class="mt-2 flex justify-start gap-2 border-t border-gray-100 pt-2 sm:justify-end">
                        <button class="rounded-lg bg-blue-700 px-3 py-2 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="mx-auto w-full max-w-4xl rounded-xl border border-gray-200 bg-white px-6 pt-4 pb-3">
                    <div class="mb-2.5 flex flex-col items-start justify-between gap-1.5 sm:flex-row sm:items-start">
                        <h2 class="text-[26px] leading-tight font-bold">Light</h2>
                        <div class="text-left sm:text-right">
                            <span class="block text-lg font-semibold text-amber-600">Ongoing</span>
                            <span class="mt-1 block text-base text-[#1f3552]"><span class="font-semibold text-[#102842]">Priority:</span> Medium</span>
                        </div>
                    </div>
                    <div class="mb-2.5 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-1.5 text-base leading-[1.4] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> Hallway 2F, IT Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">ID:</span> 112345</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> February 3, 2026, 8:07 AM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-0.5 text-[17px] font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2 text-[17px] text-[#1f3552]">Flickering fluorescent light</div>
                    <div class="mt-2 flex justify-start gap-2 border-t border-gray-100 pt-2 sm:justify-end">
                        <button class="rounded-lg bg-blue-700 px-3 py-2 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>

                <article class="mx-auto w-full max-w-4xl rounded-xl border border-gray-200 bg-white px-6 pt-4 pb-3">
                    <div class="mb-2.5 flex flex-col items-start justify-between gap-1.5 sm:flex-row sm:items-start">
                        <h2 class="text-[26px] leading-tight font-bold">Window</h2>
                        <div class="text-left sm:text-right">
                            <span class="block text-lg font-semibold text-red-500">Pending</span>
                            <span class="mt-1 block text-base text-[#1f3552]"><span class="font-semibold text-[#102842]">Priority:</span> Medium</span>
                        </div>
                    </div>
                    <div class="mb-2.5 grid max-w-[760px] grid-cols-1 gap-x-6 gap-y-1.5 text-base leading-[1.4] text-[#1f3552] md:grid-cols-2">
                        <div><span class="font-semibold text-[#102842]">Location:</span> DPT 213, New Building</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">Fullname:</span> Juan Dela Cruz</div>
                        <div class="invisible">.</div>
                        <div><span class="font-semibold text-[#102842]">Date:</span> March 2, 2026, 10:27 AM</div>
                        <div class="invisible">.</div>
                    </div>
                    <div class="mb-0.5 text-[17px] font-semibold text-[#102842]">Description:</div>
                    <div class="mb-2 text-[17px] text-[#1f3552]">Window latch broken, cannot close properly</div>
                    <div class="mt-2 flex justify-start gap-2 border-t border-gray-100 pt-2 sm:justify-end">
                        <button class="rounded-lg bg-blue-700 px-3 py-2 text-sm font-semibold text-white">Update Status</button>
                        <button class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white">Delete</button>
                    </div>
                </article>
            </section>
        </main>
    </div>

    <script>
        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('admin-main-shell').classList.add('admin-layout-nav-open');
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.setAttribute('aria-hidden', 'false');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }
        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('admin-main-shell').classList.remove('admin-layout-nav-open');
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
