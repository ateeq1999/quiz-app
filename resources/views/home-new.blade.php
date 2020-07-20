@extends('layouts.new')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome! Here are some numbers about Quiz App.</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-3 text-center">
                            <h1>{{ $quizzes }}</h1>
                            quizzes taken
                        </div>
                        <div class="col-md-6 col-sm-3 text-center">
                            {{-- <h1>{{ number_format($average, 2) }} / 10</h1>
                            average score --}}
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>
        </div>
    </div>
</div>
@endsection
