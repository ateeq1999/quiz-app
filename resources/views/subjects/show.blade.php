@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.subjects.title') - {{ $subject->title }}</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Available Topics
        </div>
        
        <div class="panel-body">
            <div class="panel-body">
                <div class="row">
                    @if ($subject->topics->count() != 0)
                        @foreach ($subject->topics as $topic)
                            @if ( $topic->questions->count() > 0 )
                                <div class="col-md-4 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            {{ $topic->title }}
                                        </div>
                                        <div class="panel-body">
                                            <a class="btn btn-outline-info btn-md" href="{{ route('tests.show', $topic->id) }}">{{ 'Click Me To Start The Quiz' }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        No Tests
                    @endif
                </div>
            </div>

            <a href="{{ route('subjects.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop