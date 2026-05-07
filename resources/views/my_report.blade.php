<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Report - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 min-h-dvh bg-gray-100 font-sans text-gray-900">
    <div id="nav-overlay" class="fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200 md:bg-black/30" aria-hidden="true" onclick="closeSideNav()"></div>

    <aside id="side-nav" class="fixed top-0 left-0 z-50 flex h-full w-[min(18rem,88vw)] -translate-x-full flex-col border-r border-red-950/40 bg-[#6b0f1a] shadow-xl transition-transform duration-200 ease-out" aria-label="Main menu">
        <div class="flex shrink-0 items-start justify-between border-b border-white/15 px-5 py-4 md:px-6">
            <a href="{{ route('dashboard') }}" onclick="closeSideNav()">
                <span class="block text-xl font-bold leading-none text-white sm:text-2xl">RepairHub</span>
                <span class="mt-1 block text-xs text-white/75">Facility Issue Reporting System</span>
            </a>
            <button type="button" onclick="closeSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-xl leading-none text-white/80 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Close menu">
                &times;
            </button>
        </div>
        <nav class="flex flex-1 flex-col gap-0.5 p-3">
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Home</a>
            <a href="{{ route('report_issue') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Report Issue</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log Out</a>
        </nav>
    </aside>

    <div id="my-report-shell" class="relative z-10 mx-auto flex min-h-dvh w-full max-w-5xl flex-col overflow-hidden bg-white shadow-none transition-[margin,width,max-width,border-radius] duration-200 ease-out md:rounded-2xl md:shadow-xl">
        <header class="flex h-16 shrink-0 items-center border-b border-white/15 bg-red-800 px-4">
            <button type="button" id="nav-menu-btn" onclick="openSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-2xl leading-none text-white/90 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-expanded="false" aria-controls="side-nav" aria-label="Open menu">
                &#9776;
            </button>
            <h1 class="ml-3 text-xl font-bold leading-none text-white">Reports</h1>
        </header>

        <main class="flex-1 bg-gray-100 p-4 sm:p-5">
            <section class="mx-auto mb-3 w-full max-w-4xl">
                <label class="mb-2 block text-lg font-semibold text-gray-900">Search Student ID:</label>
                <div class="flex items-center gap-2 rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5">
                    <input id="id-filter" type="text" placeholder="Enter Student ID" class="w-full bg-transparent text-sm text-gray-900 outline-none placeholder:text-gray-500">
                </div>
            </section>

            <section class="mx-auto mb-3 w-full max-w-4xl">
                <label class="mb-2 block text-lg font-semibold text-gray-900">Filter by Status:</label>
                <div class="relative rounded-xl border border-gray-300 bg-gray-50">
                    <select id="status-filter" class="w-full appearance-none rounded-xl bg-transparent px-3 py-2.5 pr-10 text-sm text-gray-800 outline-none">
                        <option value="all" selected>All Statuses</option>
                        <option value="resolved">Resolved</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="pending">Pending</option>
                    </select>
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-lg text-gray-500">⌄</span>
                </div>
            </section>

            <section id="report-list" class="space-y-3">
                @forelse($issues as $issue)
                <article class="mx-auto w-full max-w-4xl rounded-xl bg-gray-50 p-4" data-status="{{ strtolower($issue->status) }}" data-student-id="{{ $issue->id_number }}">
                    <div class="mb-1 flex items-start justify-between gap-3">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $issue->location }}</h2>
                        <div class="text-right">
                            @if($issue->status === 'Resolved')
                                <p class="text-base font-medium text-green-600">Resolved on: {{ $issue->updated_at->format('F j, Y, g:i A') }}</p>
                            @else
                                <p class="text-base font-medium {{ $issue->status === 'Ongoing' ? 'text-indigo-500' : 'text-amber-600' }}">
                                    {{ $issue->status }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-1 text-base text-gray-800">
                        <p><span class="font-medium text-gray-700">Location:</span> {{ $issue->location }}</p>
                        <p><span class="font-medium text-gray-700">Student ID:</span> {{ $issue->id_number }}</p>
                        <p><span class="font-medium text-gray-700">Date:</span> {{ $issue->created_at->format('F j, Y, g:i A') }}</p>
                        <p><span class="font-medium text-gray-700">Priority Level:</span> 
                            @if($issue->images->count() > 0)
                                @php
                                    $priorities = $issue->images->pluck('priority')->toArray();
                                    $displayPriority = in_array('high', $priorities) ? 'High' : (in_array('medium', $priorities) ? 'Medium' : 'Low');
                                @endphp
                                <span class="inline-block px-2 py-1 rounded text-sm font-bold text-white
                                    {{ in_array('high', $priorities) ? 'bg-red-600' : (in_array('medium', $priorities) ? 'bg-yellow-600' : 'bg-green-600') }}">
                                    {{ $displayPriority }}
                                </span>
                            @else
                                <span class="text-gray-500">Not classified</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-1 flex items-center justify-between">
                        <p class="text-base font-medium text-gray-700">Description:</p>
                    </div>
                    <p class="text-base text-gray-800">{{ $issue->description }}</p>
                    
                    @if($issue->images->count() > 0)
                    <div class="mt-4">
                        <p class="text-base font-medium text-gray-700 mb-2">Photos ({{ $issue->images->count() }}):</p>
                        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($issue->images as $image)
                            <div class="relative rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $image->photo_path) }}" alt="Issue photo" class="w-full h-32 object-cover">
                                <div class="absolute top-1 right-1 px-2 py-1 rounded text-[10px] font-bold text-white
                                    {{ $image->priority === 'high' ? 'bg-red-600' : ($image->priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600') }}">
                                    {{ strtoupper($image->priority) }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </article>
                @empty
                <div class="mx-auto w-full max-w-4xl rounded-xl bg-gray-50 p-6 text-center">
                    <p class="text-gray-500 font-medium">No reports submitted yet.</p>
                </div>
                @endforelse
            </section>
        </main>
    </div>

    <script>
        function applyDrawerLayout(isOpen) {
            var shell = document.getElementById('my-report-shell');
            var desktop = window.matchMedia('(min-width: 768px)').matches;
            if (desktop && isOpen) {
                shell.classList.add('ml-[min(18rem,88vw)]', 'mr-0', 'max-w-none', 'w-[calc(100vw-min(18rem,88vw))]', 'w-[calc(100dvw-min(18rem,88vw))]', 'rounded-none');
            } else {
                shell.classList.remove('ml-[min(18rem,88vw)]', 'mr-0', 'max-w-none', 'w-[calc(100vw-min(18rem,88vw))]', 'w-[calc(100dvw-min(18rem,88vw))]', 'rounded-none');
            }
        }

        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            applyDrawerLayout(true);
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.setAttribute('aria-hidden', 'false');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }

        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            applyDrawerLayout(false);
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
        window.addEventListener('resize', function () {
            var navOpen = !document.getElementById('side-nav').classList.contains('-translate-x-full');
            applyDrawerLayout(navOpen);
        });

        var idFilter = document.getElementById('id-filter');
        var statusFilter = document.getElementById('status-filter');
        var reportCards = document.querySelectorAll('#report-list article[data-status][data-student-id]');

        function applyFilters() {
            var selectedStatus = statusFilter.value;
            var enteredId = idFilter.value.trim();

            reportCards.forEach(function (card) {
                var cardStatus = card.getAttribute('data-status');
                var cardStudentId = card.getAttribute('data-student-id');
                var matchesStatus = selectedStatus === 'all' || cardStatus === selectedStatus;
                var matchesId = enteredId === '' || cardStudentId.includes(enteredId);
                var shouldShow = matchesStatus && matchesId;
                card.style.display = shouldShow ? '' : 'none';
            });
        }

        statusFilter.addEventListener('change', applyFilters);
        idFilter.addEventListener('input', applyFilters);
    </script>
</body>
</html>
