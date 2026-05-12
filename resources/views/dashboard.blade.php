<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 min-h-dvh bg-gray-100 font-sans text-gray-800">
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
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">Home</a>
            <a href="{{ route('report_issue') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Report Issue</a>
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Reports</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log Out</a>
        </nav>
    </aside>

    <div id="dashboard-main-shell" class="relative z-10 mx-auto flex min-h-dvh w-full max-w-5xl flex-col overflow-hidden bg-white shadow-none transition-[margin,width,max-width,border-radius] duration-200 ease-out md:rounded-2xl md:shadow-xl">
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
        <div class="space-y-8 px-4 pt-4 pb-10 sm:px-5 md:px-9 md:pt-6">
        <div class="rounded-xl bg-red-800 p-5 text-white sm:p-6">
            <h2 class="mb-2 text-2xl font-semibold">Welcome to RepairHub</h2>
            <p class="mb-5 text-sm leading-6 md:text-base">A system for reporting and tracking campus facility issues.</p>
            <div class="flex flex-col gap-2.5 sm:flex-row">
              <a href="{{ route('report_issue') }}" class="rounded-md bg-yellow-300 px-4 py-2 text-sm font-semibold text-gray-900">Report an Issue</a>
              <a href="{{ route('my_report') }}" class="rounded-md border border-white bg-white px-4 py-2 text-sm font-medium text-red-800">View Reports</a>
            </div>
        </div>
        <div class="grid gap-3.5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold">{{ $issues->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Total Reports</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-red-800">{{ $issues->where('status','Pending')->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Pending</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-amber-500">{{ $issues->where('status','Ongoing')->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Ongoing</div>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white px-3 py-4 text-center shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="text-3xl leading-none font-bold text-green-600">{{ $issues->where('status','Resolved')->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Resolved</div>
            </div>
        </div>
        <div>
            <div class="mb-3 flex items-center justify-between">
                <h3 class="text-2xl font-bold">Issues</h3>
                <button id="view-all-issues-btn" type="button" class="hidden text-sm font-medium text-red-800">View all</button>
            </div>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full border-collapse table-fixed">
                    <colgroup>
                        <col class="w-[18%]">
                        <col class="w-[34%]">
                        <col class="w-[14%]">
                        <col class="w-[14%]">
                        <col class="w-[20%]">
                    </colgroup>
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200 text-left align-middle">
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap align-middle">Location</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 align-middle">Description</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap align-middle">Status</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap align-middle">Images</th>
                            <th class="px-4 py-3 text-base font-semibold text-gray-900 whitespace-nowrap align-middle">Date</th>
                        </tr>
                    </thead>
                   <tbody id="issues-table-body">
    @forelse($issues as $issue)
    <tr class="border-b border-gray-200 hover:bg-gray-50 align-middle">
        <td class="px-4 py-3 text-base font-semibold whitespace-nowrap align-middle">{{ $issue->location }}</td>
        <td class="px-4 py-3 text-[15px] text-gray-600 align-middle">{{ $issue->description }}</td>
        <td class="px-4 py-3 text-base font-bold whitespace-nowrap align-middle
            {{ $issue->status === 'Resolved' ? 'text-green-600' : '' }}
            {{ $issue->status === 'Ongoing' ? 'text-amber-500' : '' }}
            {{ $issue->status === 'Pending' ? 'text-red-800' : '' }}">
            {{ $issue->status }}
        </td>
        <td class="py-3 text-[15px] text-gray-700 whitespace-nowrap align-middle">
            @if($issue->images->count() > 0)
                <button onclick="openImageModal({{ $issue->id }})" class="text-blue-600 hover:text-blue-800 font-medium">
                    {{ $issue->images->count() }} photo(s)
                </button>
            @else
                <span class="text-green-600 font-semibold">Sent successfully</span>
            @endif
        </td>
        <td class="py-3 pr-4 text-[15px] text-gray-500 whitespace-nowrap align-middle">{{ $issue->created_at->format('F j, Y') }}</td>
    </tr>
    @empty
    <tr class="h-32"><td colspan="5" class="py-10 text-center text-gray-400 align-middle">No issues reported yet.</td></tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
        <div class="grid w-full gap-3 sm:grid-cols-1">
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
        </div>
        </div>
    </div>

    <script>
        function applyDrawerLayout(isOpen) {
            var shell = document.getElementById('dashboard-main-shell');
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

        function openImageModal(issueId) {
            fetch(`/api/issues/${issueId}/images`)
                .then(res => res.json())
                .then(data => {
                    const modal = document.getElementById('image-modal');
                    const gallery = document.getElementById('image-gallery');
                    gallery.innerHTML = '';

                    data.images.forEach(img => {
                        const container = document.createElement('div');
                        container.className = 'relative group';
                        container.innerHTML = `
                            <img src="/storage/${img.photo_path}" alt="Issue photo" class="w-full rounded-lg border border-gray-200 object-contain max-h-96">
                            <div class="absolute top-2 left-2 px-2 py-1 rounded text-xs font-bold text-white ${img.priority === 'high' ? 'bg-red-600' : img.priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600'}">
                                ${img.priority.toUpperCase()}
                            </div>
                        `;
                        gallery.appendChild(container);
                    });

                    modal.classList.remove('hidden');
                });
        }

        function closeImageModal() {
            document.getElementById('image-modal').classList.add('hidden');
        }
    </script>

    <div id="image-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-96 overflow-auto">
            <div class="sticky top-0 flex items-center justify-between bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-xl font-bold">Issue Photos</h2>
                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="image-gallery" class="p-6 space-y-4"></div>
        </div>
    </div>
</body>
</html>