<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderByDesc('created_at')->paginate(20);
        return view('home', compact('questions'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search_text' => 'required|min:3|max:255'
        ]);
        $search_text = $request->search_text;
        $questions = Question::where('title', 'like', "%$search_text%")->paginate(20);
        return view('search', compact('search_text', 'questions'));
    }
}
