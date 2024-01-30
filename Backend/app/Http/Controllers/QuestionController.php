<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\support\facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class QuestionController extends Controller
{
    public function getQuestions()
    {
        $questions = Question::all();

        if (count($questions) > 0) {
            $result = [
                'message' => count($questions) . ' questions found',
                'data' => $questions
            ];
        } else {
            $result = [
                'message' => count($questions) . 'questions found'
            ];
        }
        return response()->json($result, 200);
    }

    public function storeQuestion(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'opt1' => 'required|string|max:255',
            'opt2' => 'required|string|max:255',
            'opt3' => 'required|string|max:255',
            'opt4' => 'required|string|max:255',
            'correct_opt' => 'required|numeric|between:1,4',
            'position_id' => 'required|exists:positions,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);

        } else {
            $data = [
                'question' => $request->question,
                'opt1' => $request->opt1,
                'opt2' => $request->opt2,
                'opt3' => $request->opt3,
                'opt4' => $request->opt4,
                'correct_opt' => $request->correct_opt,
                'position_id' => $request->position_id
            ];
            $question = Question::create($data);

            if ($question != null) {
                return response()->json([
                    'message' => 'user created successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'internal server error'
                ], 500);
            }

        }
    }

    public function generateQuiz($id)
    {
        $candidate = Candidate::find($id);
        // $question = Question::where('position_id', $candidate->post_applied_for)->inRandomOrder()->limit(10)->get();

                $questionsForPositionId9 = Question::where('position_id', 9)
                ->inRandomOrder()
                ->limit(6)
                ->get();
            
            $questionsForCandidatePosition = Question::where('position_id', $candidate->post_applied_for)
                ->inRandomOrder()
                ->limit(6)
                ->get();
            
            $questionsForPositionId10 = Question::where('position_id', 10)
                ->inRandomOrder()
                ->limit(8)
                ->get();
            
            $question = $questionsForPositionId9->concat($questionsForCandidatePosition)->concat($questionsForPositionId10);

        if ($question) {

            $result = [
                'message' => 'user created successfully',
                'status' => 200,
                'candidate_id' => $id,
                'questions' => $question
            ];
            return response()->json($result, 200);

        } else {
            return response()->json([
                'message' => 'internal server error'
            ], 500);
        }
    }

    public function startQuiz(Request $request)
    {

        $question = Question::whereIn('id', $request->input('ques'))->get();

        //  dd($request->all());

        if ($question != null) {

            return view('start', [
                'candidate_id' => $request->candidate_id,
                'questions' => $question
            ]);
        } else {
            return response()->json([
                'message' => 'internal server error'
            ], 500);
        }

    }

    public function storeQuiz(Request $request)
    {
  

        $candidate_id = $request->candidateId;

        //  $questionIds = $request->input('id');
        $obtain_marks = 0;
        $total_marks = 0;

        $testId = DB::table('tests')->insertGetId([
            'candidate_id' => $candidate_id,
            'obtain_marks' => $obtain_marks,
            'total_marks' => $total_marks,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($request->selectedAnswers as $ques) {
          
        // try {
            $correctOption = DB::table('questions')->where('id', $ques['questionId'])->value('correct_opt');
            
            // return $correctOption;
          
            if ($ques['selectedAnswer'] == $correctOption) {

                $obtain_marks++;
               
            }
            $total_marks++;

            

            DB::table('complete_tests')->insert([
                'question_id' => $ques['questionId'],
                'selected_opt' => $ques['selectedAnswer'],
                'mark' => ($ques['selectedAnswer'] == $correctOption) ? 1 : 0,
                'test_id' => $testId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        // } catch (\Throwable $th) {
        //   return response()->json(['data'=> $th->getMessage()]); 

        // }

        }

        DB::table('tests')->where('id', $testId)->update([
            'obtain_marks' => $obtain_marks,
            'total_marks' => $total_marks,
            'updated_at' => now()
        ]);

        $completeTestDetails = DB::table('tests')->where('candidate_id', $candidate_id)->first();

        //  dd($completeTestDetails);

        return response()->json(['data' => $completeTestDetails], 200);

    }

}