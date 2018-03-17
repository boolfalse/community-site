<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use Auth;
use DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $question = Question::findOrFail($id);
        //increment question views every request.
        $question->views++;
        $question->save();
        return view('question.index', compact('question'));
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'question_title' => 'required|min:5|max:64',
            'question_body' => 'required|min:10|max:1000'
        ]);
        try {
            DB::beginTransaction();
            $categories = Category::findMany(explode(',', $request->question_categories));
            $question = new Question();
            $question->title = $request->question_title;
            $question->body = $request->question_body;
            $question->uid = Auth::user()->id;
            $question->save();
            foreach ($categories as $category) {
                DB::table('category_question')->insert([
                    'question_id' => $question->id,
                    'category_id' => $category->id
                ]);
            }
            DB::commit();
            flash('Your question has been submitted.')->success();
        } catch (\Exception $exception) {
            DB::rollBack();
            flash('Error while submitting your question.')->success();
        }
        return redirect()->back();
    }

    public function makeFavorite(Request $request)
    {
        //check if already question is favourite
        $fav = DB::table('users_fav_questions')
            ->where('uid', '=', Auth::user()->id)
            ->where('question_id', '=', $request->question_id);

        //if yes make it favourite otherwise remove it from user's favourite questions.
        if ($fav->count() == 0) {
            DB::table('users_fav_questions')
                ->insert([
                    'question_id' => $request->question_id,
                    'uid' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            //just a response to check on client-side.
            return response('fav');
        } else {
            $fav->delete();
            return response('no_fav');
        }
    }

    public function vote(Request $request)
    {
        //check if valid request
        if ($request->type != 'up' || $request->type != 'down') {
            //check if question found
            if ($question = Question::find($request->question_id)) {
                return response($question->userVote($request->type));
            }
        }
        return response('', 404);
    }

    public function bestAnswer(Request $request)
    {
        //find the question
        if ($question = Question::find($request->question_id)) {
            //check if question belongs to current user and answer belongs to question.
            if ($question->uid == Auth::user()->id && $answer = $question->Answers->find($request->answer_id)) {
                if ($request->has('set_best_answer')) {
                    $question->best_answer = $answer->id;
                    $question->save();
                    flash('You just selected the best answer successfully.')->success();
                } elseif ($request->has('unset_best_answer') && $question->best_answer == $answer->id) {
                    $question->best_answer = null;
                    $question->save();
                    flash('You just unselected the best answer successfully.')->success();
                }
            }
        }
        return redirect()->back();
    }
}
