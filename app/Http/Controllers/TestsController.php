<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Subject;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();

        $data = [];
        $sub_data = [];
        $i = 0;
        $sd = 0;

        foreach ($subjects as $subject) {
            if ($subject->topics->count() > 0) {
                foreach ($subject->topics as $topic) {
                    if($topic->questions->count() > 0){
                        $data[$i] = $topic;
                        $i++;
                    }
                }
                $sub_data[$sd]['subject'] = $subject;
                $sub_data[$sd]['tests'] = $data;
                $sd++;
            }
        }

        $topics = Topic::inRandomOrder()->get();

        // $topics = Topic::inRandomOrder()->limit(10)->get();

        // $questions = Question::inRandomOrder()->limit(10)->get();
        $questions = Question::inRandomOrder()->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */

        return view('tests.test', compact('questions', 'topics', 'subjects', 'sub_data'));
        return view('tests.new', compact('questions', 'topics', 'subjects', 'sub_data'));
        // return view('tests.index', compact('questions', 'topics', 'subjects', 'sub_data'));
        
        // return view('tests.create', compact('questions'));
    }
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($topic_id)
    {
        // $questions = Question::inRandomOrder()->limit(10)->get();
        $questions = Question::where([['topic_id' , (int)$topic_id] ])->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        return view('tests.show', compact('questions'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $test->update(['result' => $result]);

        return redirect()->route('results.show', [$test->id]);
    }
}
