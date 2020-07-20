<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('isAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::whereNull('role_id')->count();
        $quizzes = Test::count();
        // $average = Test::avg('result');
        if (Auth::user()->isAdmin()) {
            return view('home', compact('questions', 'users', 'quizzes'));
            // return view('home', compact('questions', 'users', 'quizzes', 'average'));
        }else{
            return view('home-new', compact('questions', 'users', 'quizzes'));
        }
    }
}
