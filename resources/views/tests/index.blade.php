@extends('layouts.app')

@section('content')
    <h3 class="page-title">All Quizes</h3>
    {{-- <div class="panel panel-default bg-info">
        <div class="panel-heading">
            All Quizes
        </div> --}}
        <div class="panel-body">
            <div class="row">
                @foreach ($subjects as $subject)
                    <div class="col-md-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ $subject->title }}
                            </div>
                            <div class="panel-body">
                                <a class="btn btn-outline-info btn-md" href="{{ route('tests.show', $subject->id) }}">{{ 'Click Me To Start The Quiz' }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    {{-- </div> --}}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@stop
