<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function index($id)
    {
        if ($user = User::find($id))
            return view('user.index', compact('user'));
        else
            return abort(404);
    }
}
