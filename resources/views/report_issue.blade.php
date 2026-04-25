<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 bg-gray-50 font-sans">
    <div class="mx-auto my-8 w-full max-w-xl rounded-xl bg-white p-6 shadow-md">
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
        <h1 class="mb-5 text-center text-3xl font-bold text-gray-900">Report Issue</h1>
            <form id="report-form" action="/submit-issue" method="POST" enctype="multipart/form-data">            @csrf

            <label for="location" class="mb-2 block text-sm font-semibold text-gray-800">Location *</label>
            <input type="text" id="location" name="location" placeholder="e.g., Room 301, Engineering Bldg." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">

            <label for="description" class="mb-2 block text-sm font-semibold text-gray-800">Description *</label>
            <textarea id="description" name="description" placeholder="Describe the issue in detail..." required class="mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400" rows="4"></textarea>

            <label class="mb-2 block text-sm font-semibold text-gray-800">
                Upload Photo <span class="ml-2 rounded-full bg-red-100 px-2 py-0.5 text-xs text-red-600"> select priority level</span>
            </label>
            <div id="photo-preview" class="mb-4 hidden">
                <img id="preview-img" src="" alt="Preview" class="w-full rounded-md border border-gray-200 object-cover max-h-48">
                <p class="mt-1 text-xs text-gray-500">Photo selected ✓</p>
            </div>
            <div id="photo-placeholder" class="mb-3 cursor-pointer rounded-md border-2 border-dashed border-red-300 p-6 text-center text-sm text-gray-400" onclick="document.getElementById('photo-upload').click()">
                Click to upload a photo<br><span class="text-xs">JPG, PNG up to 10MB</span>
            </div>
            <div class="mb-4 flex flex-col gap-2 sm:flex-row">
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
            <div class="mb-4 flex flex-col gap-2 sm:flex-row">
                <div id="btn-low" class="w-full rounded-md bg-green-100 px-2 py-2 text-center text-sm font-medium text-green-700 sm:w-1/3">
                    Low<br><span class="text-xs font-normal">Minor Issue</span>
                </div>
                <div id="btn-medium" class="w-full rounded-md bg-yellow-100 px-2 py-2 text-center text-sm font-medium text-yellow-700 sm:w-1/3">
                    Medium<br><span class="text-xs font-normal">Affects Use</span>
                </div>
                <div id="btn-high" class="w-full rounded-md bg-red-100 px-2 py-2 text-center text-sm font-medium text-red-700 sm:w-1/3">
                    High<br><span class="text-xs font-normal">Urgent/Safety</span>
                </div>
            </div>
            <p id="priority-note" class="mb-4 text-xs text-gray-400 italic">Upload a photo above to auto-detect priority.</p>

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

    document.getElementById('report-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
   fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.querySelector('h1').classList.add('hidden');
            form.classList.add('hidden');
            const s = document.getElementById('success-screen');
            s.classList.remove('hidden');
            s.classList.add('flex');
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(err => alert('Something went wrong: ' + err));
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
            document.getElementById('btn-low').className = 'w-full sm:w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'low' ? 'bg-green-500 text-white ring-2 ring-green-400' : 'bg-green-100 text-green-700');
            document.getElementById('btn-medium').className = 'w-full sm:w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'medium' ? 'bg-yellow-500 text-white ring-2 ring-yellow-400' : 'bg-yellow-100 text-yellow-700');
            document.getElementById('btn-high').className = 'w-full sm:w-1/3 rounded-md px-2 py-2 text-center text-sm font-medium ' +
                (level === 'high' ? 'bg-red-500 text-white ring-2 ring-red-400' : 'bg-red-100 text-red-700');

            const labels = { low: 'Low priority auto-detected.', medium: 'Medium priority auto-detected.', high: '⚠️ High priority auto-detected!' };
            document.getElementById('priority-note').textContent = labels[level];
        }
    </script>
</body>
</html>