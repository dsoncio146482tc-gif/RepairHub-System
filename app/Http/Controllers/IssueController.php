<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    public function store(Request $request)
    {
        try {
            $path = null;
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('photos', 'public');
            }

            Issue::create([
                'location'    => $request->input('location'),
                'description' => $request->input('description'),
                'photo'       => $path,
                'priority'    => $request->input('priority', 'low'),
                'id_number'   => $request->input('id_number'),
                'status'      => 'Pending',
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}