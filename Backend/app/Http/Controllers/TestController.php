<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestController extends Controller
{
    
    
    public function getResult($id)
    {
        try {
            $tests = Test::whereHas('candidate', function ($query) use ($id) {
                $query->where('id', $id);
            })->with(['candidate', 'completeTests.question'])->first();
    
            if ($tests) {
                $result = [
                    'status' => 200,
                    'data' => $tests,
                ];
                return response()->json($result, 200);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Candidate not Found',
            ], 404);
        }
    
        // This block will only be reached if $candidate is not null but an error occurs
        return response()->json([
            'status' => 500,
            'message' => 'Error retrieving candidate',
        ], 500);
    }

    
    // get testcandidate only which have test
    public function getTestCandidate()
    {
        try {
            $tests = Test::join('candidates', 'tests.candidate_id', '=', 'candidates.id')
            ->get();

    
            if ($tests) {
                $result = [
                    'status' => 200,
                    'data' => $tests,
                ];
                return response()->json($result, 200);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Candidate not Found',
            ], 404);
        }
    
        // This block will only be reached if $candidate is not null but an error occurs
        return response()->json([
            'status' => 500,
            'message' => 'Error retrieving candidate',
        ], 500);
    }
}
