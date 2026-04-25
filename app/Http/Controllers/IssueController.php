<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    /**
     * COMMENT: This function handles the submission of the repair report form.
     * It saves the location, description, photo, and other details to the database.
     */
    public function store(Request $request)
    {
        try {
            $path = null;

            // 1. PHOTO UPLOAD: Checks if the user uploaded an image
            if ($request->hasFile('photo')) {
                // Saves the file to 'storage/app/public/photos' and gets the path
                $path = $request->file('photo')->store('photos', 'public');
            }

            // 2. DATABASE INSERT: Creates a new record in the 'issues' table
            Issue::create([
                'location'    => $request->input('location'),    // The room or area reported
                'description' => $request->input('description'), // Details of the damage
                'photo'       => $path,                          // The file path of the uploaded image
                'priority'    => $request->input('priority', 'low'), // High, Medium, or Low (Default: low)
                'id_number'   => $request->input('id_number'),   // ID of the student/staff reporting
                'status'      => 'Pending',                      // Initial status for all new reports
            ]);

            // 3. SUCCESS RESPONSE: Sends a JSON message back to the frontend (AJAX)
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // 4. ERROR HANDLING: If something goes wrong (e.g. Database error), return the error message
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * COMMENT: Logic for Admin to update the status (Pending -> Ongoing -> Resolved)
     */
    public function updateStatus(Request $request, $id) {
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

    /**
     * COMMENT: Logic for Admin to permanently delete a report
     */
    public function destroy($id) {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        return back()->with('success', 'Report deleted successfully!');
    }
}