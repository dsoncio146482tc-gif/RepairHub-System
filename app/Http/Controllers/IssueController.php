<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\IssueImage;
use App\Services\ImageClassificationService;

class IssueController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'location' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'id_number' => 'required|string|max:50',
                'photo' => 'nullable|array',
                'photo.*' => 'image|max:10240',
                'photo_priority' => 'nullable|array',
                'photo_priority.*' => 'nullable|in:low,medium,high'
            ]);

            $issue = Issue::create([
                'location'    => $validated['location'],
                'description' => $validated['description'],
                'photo'       => null,
                'priority'    => 'low',
                'id_number'   => $validated['id_number'],
                'status'      => 'Pending',
                'user_id'     => auth()->id(),
            ]);

            if ($request->hasFile('photo') && is_array($request->file('photo'))) {
                $photoPriorities = $validated['photo_priority'] ?? [];
                foreach ($request->file('photo') as $index => $file) {
                    if ($file && $file->isValid()) {
                        $photoPath = $file->store('photos', 'public');
                        $priority = $photoPriorities[$index] ?? 'low';

                        try {
                            if (!in_array($priority, ['low', 'medium', 'high'], true)) {
                                $priority = ImageClassificationService::classifyImage($photoPath);
                            }
                        } catch (\Throwable $fileErr) {
                            \Log::warning('Image classification failed: ' . $fileErr->getMessage());
                            $priority = $priority ?? 'low';
                        }

                        try {
                            IssueImage::create([
                                'issue_id' => $issue->id,
                                'photo_path' => $photoPath,
                                'priority' => $priority,
                                'analysis_notes' => "Auto-classified as {$priority} priority"
                            ]);
                        } catch (\Throwable $fileErr) {
                            \Log::error('Error saving image record: ' . $fileErr->getMessage());
                            continue;
                        }
                    }
                }
            }

            $issuePriority = $issue->getOverallPriority();
            if ($issuePriority !== $issue->priority) {
                $issue->update(['priority' => $issuePriority]);
            }

            return response()->json(['success' => true, 'issue_id' => $issue->id]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();
            $errorMessages = [];
            foreach ($errors as $field => $messages) {
                $errorMessages[] = implode(', ', $messages);
            }
            return response()->json([
                'success' => false,
                'error' => 'Validation error: ' . implode(' | ', $errorMessages)
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Issue creation error: ' . $e->getMessage() . ' ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'error' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);

        $currentStatus = $issue->status;
        $newStatus = 'Pending';

        if ($currentStatus === 'Pending') {
            $newStatus = 'Ongoing';
        } elseif ($currentStatus === 'Ongoing') {
            $newStatus = 'Resolved';
        }

        $issue->update(['status' => $newStatus]);
        return back()->with('success', 'Status updated successfully!');
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return back()->with('success', 'Report deleted successfully!');
    }

    public function updateImagePriority(Request $request, $imageId)
    {
        try {
            $image = IssueImage::findOrFail($imageId);
            $image->update([
                'priority' => $request->input('priority', 'low'),
                'analysis_notes' => 'Manually updated by admin'
            ]);

            return response()->json(['success' => true, 'message' => 'Priority updated']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getIssueImages($issueId)
    {
        try {
            $issue = Issue::findOrFail($issueId);
            $images = $issue->images()->get(['id', 'photo_path', 'priority'])->toArray();

            return response()->json(['success' => true, 'images' => $images]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}