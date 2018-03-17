<?php

namespace App\Http\Controllers;

use App\Answer;
use Auth;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request, [
            'question_id' => 'required|integer',
            'answer_body' => 'string|min:5|max:1000',
        ]);

        if ($user = Auth::user()) {
            $answer = new Answer();
            $answer->body = $request->answer_body;
            $answer->question_id = $request->question_id;
            $answer->uid = $user->id;
            $answer->save();
            flash('Your answer has been posted successfully.')->success();
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {

    }
}
