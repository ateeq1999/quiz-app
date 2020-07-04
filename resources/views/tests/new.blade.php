@extends('layouts.app')

@section('content')

    <!--Accordion wrapper-->
<div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
    @foreach ($sub_data as $data)

    <!-- Accordion card -->
    <div class="card">
  
      <!-- Card header -->
      <div class="card-header" role="tab" id="headingTwo2">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="{{ '#'.$data['subject']['title'] }}"
          aria-expanded="false" aria-controls="{{ $data['subject']['id'] }}">
          <h3 class="mb-0">
            {{ $data['subject']['title'] }} <i class="fas fa-angle-down rotate-icon"></i>
          </h3>
        </a>
      </div>
  
      <!-- Card body -->
      <div id="{{ $data['subject']['title'] }}"
       class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
        <div class="card-body">
            @foreach ($data['subject']['topics'] as $topic)
                <div class="col-md-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a class="btn btn-link btn-md" href="{{ route('tests.show', $topic->id) }}">{{ $topic->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
  
    </div>
    <!-- Accordion card -->
    @endforeach
  
</div>
  <!-- Accordion wrapper -->
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
