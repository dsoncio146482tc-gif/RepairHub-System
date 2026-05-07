<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 bg-gray-50 font-sans">
    <div id="nav-overlay" class="fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-200" aria-hidden="true" onclick="closeSideNav()"></div>
    <aside id="side-nav" class="fixed top-0 left-0 z-50 flex h-full w-[min(18rem,88vw)] -translate-x-full flex-col border-r border-red-950/40 bg-[#6b0f1a] shadow-xl transition-transform duration-200 ease-out" aria-label="Main menu">
        <div class="flex shrink-0 items-start justify-between border-b border-white/15 px-5 py-4 md:px-6">
            <a href="{{ route('dashboard') }}" onclick="closeSideNav()">
                <span class="block text-xl font-bold leading-none text-white sm:text-2xl">RepairHub</span>
                <span class="mt-1 block text-xs text-white/75">Facility Issue Reporting System</span>
            </a>
            <button type="button" onclick="closeSideNav()" class="flex h-8 w-8 items-center justify-center rounded-md text-xl leading-none text-white/80 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-white/40" aria-label="Close menu">
                &times;
            </button>
        </div>
        <nav class="flex flex-1 flex-col gap-0.5 p-3">
            <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold text-amber-200 hover:bg-white/10" onclick="closeSideNav()">Home</a>
            <a href="{{ route('my_report') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Reports</a>
            <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Admin Dashboard</a>
            <a href="{{ route('login') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-white/90 hover:bg-white/10" onclick="closeSideNav()">Log in</a>
        </nav>
    </aside>

    <header class="mx-auto flex h-16 w-full max-w-xl items-center gap-4 rounded-t-xl bg-red-800 px-6 text-white shadow-sm">
        <button type="button" onclick="openSideNav()" class="text-2xl hover:text-gray-200" aria-label="Open menu">☰</button>
        <h1 class="text-xl font-bold tracking-tight">Report Issue</h1>
    </header>
    <div class="mx-auto w-full max-w-xl rounded-b-xl bg-white p-6 shadow-md">
        <div id="success-screen" class="hidden flex-col items-center justify-center py-8">
    <div class="mb-6 w-full rounded-xl bg-green-50 p-8 text-center">
        <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full border-4 border-green-500">
            <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h2 class="mb-2 text-2xl font-bold text-green-700">Issue reported successfully!</h2>
        <p class="text-gray-500">Thank you for helping us improve.<br>Our team will review it shortly.</p>
    </div>
    <button onclick="window.location.href='/dashboard'"
        class="w-full rounded-xl bg-green-600 py-3 text-base font-semibold text-white hover:bg-green-700">
        Done
    </button>
</div>
            <form id="report-form" action="/submit-issue" method="POST" enctype="multipart/form-data">            @csrf

            <label for="location" class="mb-2 block text-sm font-semibold text-gray-800">Location *</label>
            <input type="text" id="location" name="location" placeholder="e.g., Room 301, Engineering Bldg." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">

            <label for="description" class="mb-2 block text-sm font-semibold text-gray-800">Description *</label>
            <textarea id="description" name="description" placeholder="Describe the issue in detail..." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" rows="4"></textarea>

            <label class="mb-2 block text-sm font-semibold text-gray-800">
                Upload Photos <span class="ml-2 rounded-full bg-blue-100 px-2 py-0.5 text-xs text-blue-600"> automatically identified priority level</span>
            </label>
            <div id="photo-preview" class="mb-4 hidden">
                <div id="preview-grid" class="grid gap-4 sm:grid-cols-2 mb-3"></div>
                <p class="text-xs text-gray-500 bg-blue-50 p-2 rounded">✓ Photos analyzed and classified</p>
            </div>
            <div id="photo-placeholder" class="mb-3 cursor-pointer rounded-md border-2 border-dashed border-red-300 p-6 text-center text-sm text-gray-400" onclick="document.getElementById('photo-upload').click()">
                Click to upload photos<br><span class="text-xs">JPG, PNG up to 10MB each</span>
            </div>
            <div class="mb-4 flex flex-col gap-2 sm:flex-row">
                <button type="button" onclick="document.getElementById('photo-upload').click()"
                    class="flex-1 rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                     Upload from Gallery
                </button>
                <button type="button" onclick="document.getElementById('photo-camera').click()"
                    class="flex-1 rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    Take a Photo
                </button>
            </div>
            <input type="file" id="photo-upload" name="photo[]" accept="image/*" multiple class="hidden" onchange="handlePhoto(this)">
            <input type="file" id="photo-camera" name="photo[]" accept="image/*" capture="environment" multiple class="hidden" onchange="handlePhoto(this)">

            <label for="id-number" class="mb-2 block text-sm font-semibold text-gray-800">Student ID *</label>
            <input type="text" id="id-number" name="id_number" placeholder="Enter your Student ID" required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">

            <div class="flex items-center justify-between gap-3">
                <button type="button" onclick="window.history.back()" class="min-w-[140px] rounded-md border border-gray-300 bg-gray-100 px-8 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-200">Cancel</button>
                <button type="submit" class="min-w-[140px] rounded-md bg-red-700 px-8 py-2.5 text-sm font-semibold text-white hover:bg-red-800">Submit</button>
            </div>
        </form>
        </div>
    </div>

    <script>

    let selectedFiles = [];
    let filePriorities = []; // Maps file index to priority

    document.getElementById('report-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const formData = new FormData(form);

    // Clear existing photo files and add all selected files with their priority values
    formData.delete('photo[]');
    formData.delete('photo_priority[]');
    selectedFiles.forEach((file, index) => {
        formData.append('photo[]', file);
        formData.append('photo_priority[]', filePriorities[index] || 'low');
    });

   fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }
        return res.json();
    })
    .then(data => {
        if (data.success) {
            document.querySelector('h1').classList.add('hidden');
            form.classList.add('hidden');
            const s = document.getElementById('success-screen');
            s.classList.remove('hidden');
            s.classList.add('flex');
        } else {
            const errorMsg = data.error || 'Unknown error occurred';
            alert('Error: ' + errorMsg);
        }
    })
    .catch(err => {
        console.error('Form submission error:', err);
        alert('Something went wrong: ' + err.message);
    });
});

        function handlePhoto(input) {
            if (!input.files || input.files.length === 0) return;
            const files = Array.from(input.files);

            // Add new files to the selected files array (avoid duplicates by name and size)
            files.forEach(file => {
                const isDuplicate = selectedFiles.some(existing =>
                    existing.name === file.name && existing.size === file.size
                );
                if (!isDuplicate) {
                    selectedFiles.push(file);
                }
            });

            // Keep priority list in sync with selected files
            filePriorities = selectedFiles.map((_, index) => filePriorities[index] || 'low');
            updatePreview();
            detectPriority(selectedFiles);
        }

        function updatePreview() {
            const previewGrid = document.getElementById('preview-grid');
            previewGrid.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview';
                    img.className = 'w-full rounded-md border border-gray-200 object-contain max-h-64';

                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative';

                    // Add priority badge
                    const priority = filePriorities[index] || 'analyzing...';
                    const priorityBadge = document.createElement('div');
                    priorityBadge.className = 'absolute top-2 right-2 px-2 py-1 rounded text-xs font-bold text-white ' +
                        (priority === 'high' ? 'bg-red-600' : priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600');
                    priorityBadge.textContent = priority.toUpperCase();
                    priorityBadge.id = `priority-badge-${index}`;

                    // Add remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute bottom-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 text-sm hover:bg-red-600 font-bold';
                    removeBtn.textContent = '×';
                    removeBtn.onclick = () => removePhoto(index);

                    wrapper.appendChild(img);
                    wrapper.appendChild(priorityBadge);
                    wrapper.appendChild(removeBtn);
                    previewGrid.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            if (selectedFiles.length > 0) {
                document.getElementById('photo-preview').classList.remove('hidden');
                document.getElementById('photo-placeholder').classList.add('hidden');
            }
        }

        function removePhoto(index) {
            selectedFiles.splice(index, 1);
            filePriorities.splice(index, 1);
            updatePreview();
            if (selectedFiles.length === 0) {
                document.getElementById('photo-preview').classList.add('hidden');
                document.getElementById('photo-placeholder').classList.remove('hidden');
            }
            detectPriority(selectedFiles);
        }

        function detectPriority(files) {
            // Simulate AI image analysis for each file
            files.forEach((file, index) => {
                // Create a FileReader to analyze the image
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        canvas.width = img.width;
                        canvas.height = img.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        
                        // Get image data for analysis
                        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        const data = imageData.data;
                        
                        // Analyze pixel colors to detect damage patterns
                        let darkPixels = 0;
                        let brownishPixels = 0;
                        let totalPixels = data.length / 4;
                        
                        for (let i = 0; i < data.length; i += 4) {
                            const r = data[i];
                            const g = data[i + 1];
                            const b = data[i + 2];
                            const brightness = (r + g + b) / 3;
                            
                            // Dark pixels (cracks, deep damage)
                            if (brightness < 85) darkPixels++;
                            
                            // Brownish/reddish tones (rust, stains)
                            if (r > g && r > b && r > 100) brownishPixels++;
                        }
                        
                        // Calculate damage score
                        let damageScore = 0;
                        const darkPercentage = (darkPixels / totalPixels) * 100;
                        const brownishPercentage = (brownishPixels / totalPixels) * 100;
                        
                        if (darkPercentage > 40) damageScore += 40;
                        else if (darkPercentage > 25) damageScore += 20;
                        
                        if (brownishPercentage > 35) damageScore += 30;
                        else if (brownishPercentage > 15) damageScore += 15;
                        
                        // Determine priority
                        let priority = 'low';
                        if (damageScore >= 65) priority = 'high';
                        else if (damageScore >= 35) priority = 'medium';
                        
                        filePriorities[index] = priority;
                        
                        // Update badge
                        const badge = document.getElementById(`priority-badge-${index}`);
                        if (badge) {
                            badge.textContent = priority.toUpperCase();
                            badge.className = 'absolute top-2 right-2 px-2 py-1 rounded text-xs font-bold text-white ' +
                                (priority === 'high' ? 'bg-red-600' : priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600');
                        }
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }

        function openSideNav() {
            document.getElementById('side-nav').classList.remove('-translate-x-full');
            document.getElementById('nav-overlay').classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeSideNav() {
            document.getElementById('side-nav').classList.add('-translate-x-full');
            document.getElementById('nav-overlay').classList.add('opacity-0', 'pointer-events-none');
        }
    </script>
</body>
</html>