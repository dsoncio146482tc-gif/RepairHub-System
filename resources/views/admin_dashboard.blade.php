<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <div id="nav-overlay" class="fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200" onclick="closeSideNav()"></div>

    <aside id="side-nav" class="fixed top-0 left-0 z-50 flex h-full w-64 -translate-x-full flex-col bg-[#6b0f1a] shadow-xl transition-transform duration-200 ease-out">
        <div class="border-b border-white/15 px-6 py-5">
            <span class="block text-xl font-bold text-white">RepairHub</span>
            <span class="text-[10px] text-white/70 uppercase tracking-wider">Admin Portal</span>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white hover:bg-white/10">Home</a>
            <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-4 py-2.5 text-sm font-bold text-amber-300 bg-white/10">Admin Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button class="w-full text-left rounded-lg px-4 py-2.5 text-sm font-medium text-red-200 hover:bg-red-900/50">Logout</button>
            </form>
        </nav>
    </aside>

    <div id="admin-main-shell" class="mx-auto min-h-screen max-w-5xl bg-white shadow-lg transition-all duration-200">
        
        <header class="flex h-16 items-center gap-4 bg-red-800 px-6 text-white">
            <button onclick="openSideNav()" class="text-2xl hover:text-gray-200">☰</button>
            <h1 class="text-xl font-bold tracking-tight">Admin Dashboard</h1>
        </header>

        <main class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-center">
                    <div class="text-2xl font-bold">{{ $issues->count() }}</div>
                    <div class="text-[11px] font-bold text-gray-500 uppercase">Total</div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $issues->where('status','Pending')->count() }}</div>
                    <div class="text-[11px] font-bold text-gray-500 uppercase">Pending</div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-center">
                    <div class="text-2xl font-bold text-amber-600">{{ $issues->where('status','Ongoing')->count() }}</div>
                    <div class="text-[11px] font-bold text-gray-500 uppercase">Ongoing</div>
                </div>
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $issues->where('status','Resolved')->count() }}</div>
                    <div class="text-[11px] font-bold text-gray-500 uppercase">Resolved</div>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($issues as $issue)
                <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">{{ $issue->location }}</h2>
                            <p class="text-[11px] font-bold text-gray-400 uppercase">Issue ID: #{{ $issue->id_number }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                            {{ $issue->status === 'Resolved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $issue->status === 'Ongoing' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $issue->status === 'Pending' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $issue->status }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm mb-4 border-y border-gray-50 py-3">
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase">Reported Date</span>
                            <span class="font-medium text-gray-700">{{ $issue->created_at->format('F d, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase">Priority Level</span>
                            <span class="font-medium {{ $issue->priority === 'high' ? 'text-red-600' : 'text-gray-700' }}">
                                {{ ucfirst($issue->priority) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Description</span>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $issue->description }}</p>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                        <form action="{{ route('admin.updateStatus', $issue->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-bold text-white hover:bg-blue-700 transition">
                                Update Status
                            </button>
                        </form>

                        <form action="{{ route('admin.deleteIssue', $issue->id) }}" method="POST" onsubmit="return confirm('Delete this report permanently?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg bg-red-50 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-100 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
                @empty
                <div class="text-center py-10 text-gray-400">No issues found.</div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('nav-overlay').classList.replace('opacity-0', 'opacity-100');
            document.getElementById('nav-overlay').classList.remove('pointer-events-none');
        }
        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('nav-overlay').classList.replace('opacity-100', 'opacity-0');
            document.getElementById('nav-overlay').classList.add('pointer-events-none');
        }
    </script>
</body>
</html>