@extends('layouts.app')

@section('content')
    <h3 class="page-title">All Quizes</h3>
    <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
        <div class="panel-body">
            <div class="row">
                @foreach ($sub_data as $data)
                        <div class="col-md-4 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="btn btn-link btn-lg" data-toggle="collapse" data-parent="#accordionEx" href="{{ '#'.$data['subject']['title'] }}"
                                    aria-expanded="false" aria-controls="{{ $data['subject']['id'] }}">
                                    {{ $data['subject']['title'] }}
                                        <h3 class="mb-0">
                                        </h3>
                                    </a>
                                </div>
                                <div class="collapse panel-body" id="{{ $data['subject']['title'] }}"
                                role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
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
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('#accordionEx').collapse({
        toggle: false
        })
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@stop
