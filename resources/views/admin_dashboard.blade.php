<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - RepairHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <div id="nav-overlay" class="fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200" onclick="closeSideNav()"></div>

    <aside id="side-nav" class="fixed top-0 left-0 z-50 flex h-full w-64 -translate-x-full flex-col bg-[#6b0f1a] shadow-xl transition-transform duration-200 ease-out">
        <div class="border-b border-white/15 px-6 py-5">
            <a href="{{ route('dashboard') }}" class="block text-xl font-bold text-white">RepairHub</a>
            <span class="text-[10px] text-white/70 uppercase tracking-wider font-bold">Admin Portal</span>
        </div>
        
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2.5 text-sm font-medium text-white hover:bg-white/10 transition">
                Home
            </a>

            <div class="block rounded-lg px-4 py-2.5 text-sm font-bold text-amber-300 bg-white/10">
                Dashboard Overview
            </div>
            
            <div class="pt-4 mt-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left rounded-lg px-4 py-2.5 text-sm font-medium text-red-200 hover:bg-red-900/50 transition">
                        Logout Account
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <div id="admin-main-shell" class="mx-auto min-h-screen max-w-5xl bg-white shadow-lg transition-all duration-200">
        
        <header class="flex h-16 items-center gap-4 bg-red-800 px-6 text-white shadow-md">
            <button onclick="openSideNav()" class="text-2xl hover:text-gray-200 transition">☰</button>
            <h1 class="text-xl font-bold tracking-tight">Admin Management</h1>
        </header>

        <main class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="rounded-xl border border-gray-200 bg-white p-4 text-center shadow-sm">
                    <div class="text-2xl font-bold text-gray-800">{{ $issues->count() }}</div>
                    <div class="text-[10px] font-black text-gray-400 uppercase">Total Reports</div>
                </div>
                <div class="rounded-xl border border-red-100 bg-red-50 p-4 text-center shadow-sm">
                    <div class="text-2xl font-bold text-red-600">{{ $issues->where('status','Pending')->count() }}</div>
                    <div class="text-[10px] font-black text-red-400 uppercase">Pending</div>
                </div>
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4 text-center shadow-sm">
                    <div class="text-2xl font-bold text-amber-600">{{ $issues->where('status','Ongoing')->count() }}</div>
                    <div class="text-[10px] font-black text-amber-400 uppercase">In Progress</div>
                </div>
                <div class="rounded-xl border border-green-100 bg-green-50 p-4 text-center shadow-sm">
                    <div class="text-2xl font-bold text-green-600">{{ $issues->where('status','Resolved')->count() }}</div>
                    <div class="text-[10px] font-black text-green-400 uppercase">Resolved</div>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($issues as $issue)
                <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-red-200 transition">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">{{ $issue->location }}</h2>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter">ID: #{{ $issue->id_number }}</span>
                                <span class="text-gray-300">|</span>
                                @if($issue->images->count() > 0)
                                    @php
                                        $priorities = $issue->images->pluck('priority')->toArray();
                                        $highestPriority = in_array('high', $priorities) ? 'high' : (in_array('medium', $priorities) ? 'medium' : 'low');
                                    @endphp
                                    <span class="text-[11px] font-bold {{ $highestPriority === 'high' ? 'text-red-500' : ($highestPriority === 'medium' ? 'text-yellow-600' : 'text-green-600') }} uppercase">
                                        {{ ucfirst($highestPriority) }} Priority
                                    </span>
                                @else
                                    <span class="text-[11px] font-bold text-gray-500 uppercase">Not Classified</span>
                                @endif
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase shadow-sm
                            {{ $issue->status === 'Resolved' ? 'bg-green-500 text-white' : '' }}
                            {{ $issue->status === 'Ongoing' ? 'bg-amber-500 text-white' : '' }}
                            {{ $issue->status === 'Pending' ? 'bg-red-600 text-white' : '' }}">
                            {{ $issue->status }}
                        </span>
                    </div>

                    <div class="mb-5 bg-gray-50 rounded-lg p-3 border-l-4 border-gray-200">
                        <span class="block text-[10px] font-black text-gray-400 uppercase mb-1">User Description</span>
                        <p class="text-sm text-gray-700 leading-relaxed italic">"{{ $issue->description }}"</p>
                    </div>

                    @if($issue->images->count() > 0)
                    <div class="mb-5 bg-blue-50 rounded-lg p-4 border-l-4 border-blue-300">
                        <div class="flex flex-col gap-3">
                            <span class="block text-[10px] font-black text-gray-600 uppercase">Photos ({{ $issue->images->count() }}) - Click to change priority</span>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach($issue->images as $image)
                                <div class="group overflow-hidden rounded-xl border bg-white shadow-sm transition hover:shadow-md {{ $image->priority === 'high' ? 'border-red-200' : ($image->priority === 'medium' ? 'border-amber-200' : 'border-emerald-200') }}">
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->photo_path) }}" alt="Issue photo" class="h-40 w-full object-cover">
                                        <div class="absolute left-3 top-3 rounded-full px-2 py-1 text-[10px] font-semibold uppercase shadow-sm {{ $image->priority === 'high' ? 'bg-red-600 text-white' : ($image->priority === 'medium' ? 'bg-amber-500 text-slate-900' : 'bg-emerald-600 text-white') }}">
                                            {{ strtoupper($image->priority) }}
                                        </div>
                                        <div class="absolute inset-0 bg-black/30 opacity-0 transition duration-200 group-hover:opacity-100 flex items-center justify-center">
                                            <div class="grid gap-2 rounded-lg bg-black/60 p-3 text-center">
                                                <button onclick="updateImagePriority({{ $image->id }}, 'low')" class="rounded-md bg-emerald-600 px-3 py-2 text-xs font-bold text-white hover:bg-emerald-700">LOW</button>
                                                <button onclick="updateImagePriority({{ $image->id }}, 'medium')" class="rounded-md bg-amber-500 px-3 py-2 text-xs font-bold text-slate-900 hover:bg-amber-600">MED</button>
                                                <button onclick="updateImagePriority({{ $image->id }}, 'high')" class="rounded-md bg-red-600 px-3 py-2 text-xs font-bold text-white hover:bg-red-700">HIGH</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between gap-3 border-t px-3 py-2">
                                        <span class="text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">Priority</span>
                                        <span class="rounded-full px-3 py-1 text-[11px] font-semibold uppercase {{ $image->priority === 'high' ? 'bg-red-600 text-white' : ($image->priority === 'medium' ? 'bg-amber-500 text-slate-900' : 'bg-emerald-600 text-white') }}">
                                            {{ strtoupper($image->priority) }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                        <span class="text-[11px] text-gray-400">Reported: <b>{{ $issue->created_at->diffForHumans() }}</b></span>
                        
                        <div class="flex gap-2">
                            <form action="{{ route('admin.updateStatus', $issue->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-bold text-white hover:bg-blue-700 transition shadow-md">
                                    Update Status
                                </button>
                            </form>

                            <form action="{{ route('admin.deleteIssue', $issue->id) }}" method="POST" onsubmit="return confirm('Delete this report permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-lg bg-white border border-red-200 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-50 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
                @empty
                <div class="text-center py-20 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 font-medium">No facility issues reported yet.</p>
                </div>
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

        function updateImagePriority(imageId, priority) {
            fetch(`/admin/images/${imageId}/priority`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ priority: priority })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(err => alert('Error updating priority'));
        }
    </script>
</body>
</html>