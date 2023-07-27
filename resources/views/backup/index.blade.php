@extends('layouts.app')
@section('title', __('lang_v1.backup'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('lang_v1.backup')
    </h1>
</section>

<!-- Main content -->
<section class="content">
    
  @if (session('notification') || !empty($notification))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                @if(!empty($notification['msg']))
                    {{$notification['msg']}}
                @elseif(session('notification.msg'))
                    {{ session('notification.msg') }}
                @endif
              </div>
          </div>  
      </div>     
  @endif

  <div class="row">
    <div class="col-sm-12">
      @component('components.widget', ['class' => 'box-primary'])
        @slot('tool')
          <div class="box-tools">
              @can('backup')
                    <a id="create-new-backup-button"  style="margin: 10px;margin-top: 20px" href="{{ url('backup/create') }}" class="btn btn-primary pull-right"
                     style="margin-bottom:2em;"><i
                              class="fa fa-plus"></i> @lang('lang_v1.create_new_backup')
                    </a>
              @endcan
          </div>
        @endslot
        @if (count($backups))
                <table class="table table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>@lang('lang_v1.file')</th>
                      <th>@lang('lang_v1.size')</th>
                      <th>@lang('lang_v1.date')</th>
                      <th>@lang('lang_v1.age')</th>
                      <th>@lang('messages.actions')</th>
                  </tr>
                  </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        @php $restoreUrl = url('backup/restore/'.$backup['name']); @endphp
                        <tr>
                            <td>{{ $backup['name'] }}</td>
                            <td>{{ humanFilesize($backup['size_raw']) }}</td>
                            <td>
                                {{ $backup['date'] }}
                            </td>
                            <td>
                                {{ @format_datetime(date('Y-m-d H:i')) }}
                            </td>
                            <td>
                              <a class="btn btn-xs btn-success"
                                   href="{{action('BackUpController@download', [$backup['name']])}}"><i
                                        class="fa fa-cloud-download"></i> @lang('lang_v1.download')</a>
                                <a class="btn btn-xs btn-danger link_confirmation" data-button-type="delete"
                                   href="{{action('BackUpController@delete', [$backup['name']])}}"><i class="fa fa-trash-o"></i>
                                    @lang('messages.delete')</a>
                                @can('backup.restore')
                                <a class="btn btn-xs btn-primary link_confirmation" data-button-type="restore"
                                   href="{{$restoreUrl}}"><i class="fa fa-undo"></i>
                                    Restore</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
              </table>
            @else
                <div class="well">
                    <h4>There are no backups</h4>
                </div>
            @endif
            <br>
            <strong>@lang('lang_v1.auto_backup_instruction'):</strong><br>
        <code>{{$cron_job_command}}</code>
      @endcomponent
    </div>
  </div>
</section>
<div class="modal-dialog modal-lg no-print" role="document" style="width: 70%;" id="uploadBackup">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle"> 
      Upload Database Backup
    </h4>
</div>
@can('backup.upload')
@can('backup.restore')
    <div class="modal-body">
         {!! Form::open(['url' => action('BackUpController@store'), 'method' => 'post', 'id'=>'upload_backup_form','files' => true ]) !!}
    
        <div class="row">
             <div class="col-6" style="margin-left:20px">
                  <div class="form-group">
                    {!! Form::label('Upload Backup') !!} {!! Form::file('backup', ['id' => 'backup', 'accept' => '.gz,.tar','required'=>true]); !!}
                   </div>
            </div>
        </div>
       <div class="modal-footer">
            <button type="submit" class="btn btn-default no-print" data-dismiss="modal">Upload</button>
        </div>
         {!! Form::close() !!}
      </div>
@endcan
@endcan 
</div>



@if(session('status'))
    
    @if(session('status')[0]["success"] == 1)
        <script>
            toastr.success("{{ session('status')[0]['msg'] }}");
        </script>
    @elseif(session('status')[0]["success"] == 0)
        <script>toastr.error("{{ session('status')[0]['msg'] }}");</script>
    @endif

@endif

   

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>

@endsection