<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --nav-drawer-width: min(18rem, 88vw); }
        #side-nav { width: var(--nav-drawer-width); }
        #report-main-shell {
            transition: margin 0.2s ease-out, width 0.2s ease-out, max-width 0.2s ease-out, border-radius 0.2s ease-out;
        }
        #report-main-shell.report-layout-nav-open {
            margin-left: var(--nav-drawer-width);
            margin-right: 0;
            max-width: none;
            width: calc(100vw - var(--nav-drawer-width));
            width: calc(100dvw - var(--nav-drawer-width));
            border-radius: 0;
        }
    </style>
</head>
<body class="m-0 min-h-dvh bg-gray-50 font-sans text-gray-900">
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
            <a href="{{ route('report_issue') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">Report Issue</a>
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">My Report</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log in</a>
        </nav>
    </aside>

    <div id="report-main-shell" class="relative z-10 mx-auto my-8 w-full max-w-xl overflow-hidden rounded-xl bg-white shadow-md">
        <header class="flex h-16 shrink-0 items-center gap-2.5 border-b border-white/15 bg-red-800 px-4 md:px-5">
            <button type="button" id="nav-menu-btn" onclick="openSideNav()" class="flex size-8 shrink-0 items-center justify-center rounded-md text-lg leading-none text-white/90 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-expanded="false" aria-controls="side-nav" aria-label="Open menu">
                &#9776;
            </button>
            <h1 class="text-2xl font-bold leading-none tracking-tight text-white">Report Issue</h1>
        </header>
        <div class="p-6 pt-5">
        <form action="/submit-issue" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="location" class="mb-2 block text-sm font-semibold text-gray-800">Location *</label>
            <input type="text" id="location" name="location" placeholder="e.g., Room 301, Engineering Bldg." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">

            <label for="description" class="mb-2 block text-sm font-semibold text-gray-800">Description *</label>
            <textarea id="description" name="description" placeholder="Describe the issue in detail..." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" rows="4"></textarea>

            <label class="mb-2 block text-sm font-semibold text-gray-800">
                Upload Photo <span class="ml-2 rounded-full bg-red-100 px-2 py-0.5 text-xs text-red-600">automatically assign priority</span>
            </label>
            <div id="photo-preview" class="mb-4 hidden">
                <img id="preview-img" src="" alt="Preview" class="w-full rounded-md border border-gray-200 object-cover max-h-48">
                <p class="mt-1 text-xs text-gray-500">Photo selected ✓</p>
            </div>
            <div id="photo-placeholder" class="mb-3 cursor-pointer rounded-md border-2 border-dashed border-red-300 p-6 text-center text-sm text-gray-400" onclick="document.getElementById('photo-upload').click()">
                Click to upload a photo<br><span class="text-xs">JPG, PNG up to 10MB</span>
            </div>
            <div class="mb-4 flex gap-2">
                <button type="button" onclick="document.getElementById('photo-upload').click()"
                    class="flex-1 rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    📁 Upload from Gallery
                </button>
                <button type="button" onclick="document.getElementById('photo-camera').click()"
                    class="flex-1 rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    📷 Take a Photo
                </button>
            </div>
            <input type="file" id="photo-upload" name="photo" accept="image/*" class="hidden" onchange="handlePhoto(this)">
            <input type="file" id="photo-camera" name="photo" accept="image/*" capture="environment" class="hidden" onchange="handlePhoto(this)">

            <input type="hidden" id="priority-input" name="priority" value="low">
            <label class="mb-2 block text-sm font-semibold text-gray-800">Priority Level</label>
            <div class="mb-4 flex gap-2">
                <div id="btn-low" class="w-1/3 rounded-md bg-green-100 px-2 py-2 text-center text-sm font-medium text-green-700">
                    Low<br><span class="text-xs font-normal">Minor Issue</span>
                </div>
                <div id="btn-medium" class="w-1/3 rounded-md bg-yellow-100 px-2 py-2 text-center text-sm font-medium text-yellow-700">
                    Medium<br><span class="text-xs font-normal">Affects Use</span>
                </div>
                <div id="btn-high" class="w-1/3 rounded-md bg-red-100 px-2 py-2 text-center text-sm font-medium text-red-700">
                    High<br><span class="text-xs font-normal">Urgent/Safety</span>
                </div>
            </div>
            <p id="priority-note" class="mb-4 text-xs text-gray-400 italic">Upload a photo above to auto-detect priority.</p>

            <label for="id-number" class="mb-2 block text-sm font-semibold text-gray-800">Student ID *</label>
            <input type="text" id="id-number" name="id_number" placeholder="Enter your Student ID" required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">

            <div class="flex flex-col items-center gap-3">
                <button type="submit" class="w-full max-w-xs rounded-md bg-red-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-800">Submit</button>
                <button type="button" onclick="window.history.back()" class="w-full max-w-xs rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm text-gray-600 hover:bg-gray-200">Cancel</button>
            </div>
        </form>
        </div>
    </div>

    <script>
        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('report-main-shell').classList.add('report-layout-nav-open');
            var overlay = document.getElementById('nav-overlay');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.setAttribute('aria-hidden', 'false');
            document.getElementById('nav-menu-btn').setAttribute('aria-expanded', 'true');
            document.body.classList.add('overflow-hidden');
        }
        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('report-main-shell').classList.remove('report-layout-nav-open');
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

        function handlePhoto(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('photo-preview').classList.remove('hidden');
                document.getElementById('photo-placeholder').classList.add('hidden');
                detectPriority(file);
            };
            reader.readAsDataURL(file);
        }

        function detectPriority(file) {
            const name = file.name.toLowerCase();
            const size = file.size;
            let priority = 'low';

            // Rule-based detection
            if (name.includes('fire') || name.includes('flood') || name.includes('broken') ||
                name.includes('danger') || name.includes('electric') || name.includes('crack')) {
                priority = 'high';
            } else if (size > 2 * 1024 * 1024) {
                // Larger images often mean more serious visible damage
                priority = 'medium';
            } else {
                priority = 'low';
            }

            setPriority(priority);
        }

        function setPriority(level) {
            document.getElementById('priority-input').value = level;
            document.getElementById('btn-low').className = 'w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'low' ? 'bg-green-500 text-white ring-2 ring-green-400' : 'bg-green-100 text-green-700');
            document.getElementById('btn-medium').className = 'w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'medium' ? 'bg-yellow-500 text-white ring-2 ring-yellow-400' : 'bg-yellow-100 text-yellow-700');
            document.getElementById('btn-high').className = 'w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'high' ? 'bg-red-500 text-white ring-2 ring-red-400' : 'bg-red-100 text-red-700');

            const labels = { low: 'Low priority auto-detected.', medium: 'Medium priority auto-detected.', high: '⚠️ High priority auto-detected!' };
            document.getElementById('priority-note').textContent = labels[level];
        }
    </script>
</body>
</html>