@extends('layouts.new')

@section('content')
<section class="container">
    <h3 class="mb-0">All Subjects</h3>
    <div id="accordion" class="accordion-container">
        @foreach ($sub_data as $data)
        <div class="card">
            <div class="card-header" id="{{ $data['subject']['title'].$data['subject']['id'] }}">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="{{ '#'.$data['subject']['id'] }}" aria-expanded="false" aria-controls="collapseThree">
                    {{ $data['subject']['title'] }}
                </button>
            </h5>
            </div>
            <div id="{{ $data['subject']['id'] }}" class="collapse" aria-labelledby="{{ $data['subject']['title'].$data['subject']['id'] }}" data-parent="#accordion">
            <div class="card-body">
                @foreach ($data['subject']['topics'] as $topic)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a class="btn btn-outline-info btn-md" href="{{ route('tests.show', $topic->id) }}">
                                {{ $topic->title }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
        @endforeach
    </div>
    
</section>
@stop
