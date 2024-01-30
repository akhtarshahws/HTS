<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\support\facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCandidate()
    {
        $candidates = Candidate::orderBy('created_at', 'desc')->get();

        if (count($candidates) > 0) {
            $result = [
                'message' => count($candidates) . ' user found',
                'data' => $candidates,
            ];
        } else {
            $result = [
                'message' => count($candidates) . ' user found',
            ];
        }
        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCandidate(Request $request)
     
    // return response()->json([
    //     'data' => $request->all()
    // ]);

    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:55',
            'father_name' => 'required|string|max:55',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:15',
            'post_applied_for' => 'required|string|max:255',
            'skills' => 'required|string',
            'interviewer' => 'required|string|max:55'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);

        } else {
            $data = [
                'name' => $request->name,
                'father_name' => $request->father_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_applied_for' => $request->post_applied_for,
                'skills' => $request->skills,
                'interviewer' => $request->interviewer,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $candidate = DB::table('candidates')->insertGetId($data);


            if ($candidate != null) {

                // $question= Question::where('position_id',$request->post_applied_for)->inRandomOrder()->limit(10)->get();

                #===================== api code ============================

                return response()->json([
                    'candidate_id' => $candidate
                    // 'questions'=> $question
                ], 200);

                #==================== view code =============================

                // return view('createcandidate', [
                //     'message'=> 'user created successfully',
                //     'candidate_id'=> $candidate,
                //     // 'questions'=> $question
                // ]);
            } else {

                return response()->json([
                    'message' => 'internal server error'
                ], 500);
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $candidate = Candidate::findOrFail($id);
    
            if ($candidate) {
                $result = [
                    'status' => 200,
                    'candidate' => $candidate,
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:55',
            'father_name' => 'required|string|max:55',
            // 'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|string|max:15',
            'post_applied_for' => 'required|string|max:255',
            'skills' => 'required|string',
            'interviewer' => 'required|string|max:55'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);

        } else {
            $data = [
                'name' => $request->name,
                'father_name' => $request->father_name,
                // 'email' => $request->email,
                'phone' => $request->phone,
                'post_applied_for' => $request->post_applied_for,
                'skills' => $request->skills,
                'interviewer' => $request->interviewer
            ];
            $candidate = Candidate::findOrFail($id);
            $candidate->update($data);


            if ($candidate != null) {

                // $question= Question::where('position_id',$request->post_applied_for)->inRandomOrder()->limit(10)->get();

                #===================== api code ============================

                return response()->json([
                    'message' => 'candidate updated successfully'
                    //   'question'=> $question
                ], 200);

                #==================== view code =============================

                // return view('createcandidate', [
                //     'message'=> 'user created successfully',
                //     'candidate_id'=> $candidate,
                //     // 'questions'=> $question
                // ]);
            } else {

                return response()->json([
                    'message' => 'internal server error'
                ], 500);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $candidate = Candidate::findOrFail($id);
    
            if ($candidate) {
                $candidate->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Candidate Deleted Successfully',
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Candidate not Found',
            ], 404);
        }
    
        // This block will only be reached if $candidate is not null but the deletion fails for some reason
        return response()->json([
            'status' => 500,
            'message' => 'Error deleting candidate',
        ], 500);
    }
}

