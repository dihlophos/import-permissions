@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    @if(Gate::allows('modify-export', $institution_id))
        <a href="{{route('indi_export.create',['institution'=>$institution_id])}}" class="btn btn-primary" role="button">Добавить</a><br/><br/>
    @endif

    @if (count($indi_exports) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
          Вывоз
        </div>

        <div class="panel-body">
          {{$indi_exports->links()}}
          <table class="table table-striped task-table">
            <thead>
                <th>Код</th>
                <th>Редактировать</th>
                <th>Разрешение</th>
                <th>На заявку</th>
                <th>Удалить</th>
            </thead>
            <tbody>
              @foreach ($indi_exports as $indi_export)
                  @can('view', $indi_export)
                    <tr>
                        <td class="table-text">
                            {{$indi_export->id}}
                        </td>
                        <td class="table-text">
                            @can('update', $indi_export)
                                <a href="{{route('indi_export.edit', $indi_export->id)}}" class="btn btn-primary" role="button">Редактировать</a>
                            @endcan
                        </td>
                        <td class="table-text" style="width:">
                            <div style="float: left;">
                                от <u>{{empty($indi_export->permission_date)?str_repeat('&nbsp;',20):$indi_export->permission_date}}</u>
                                № <u>{{empty($indi_export->permission_num)?str_repeat('&nbsp;', 6):$indi_export->institution->region->index.'-'.$indi_export->institution->index.'-'.$indi_export->permission_num}}</u>
                            </div>
                            <div style="float: right; padding-left:10px">
                                @can('specifyPermission', $indi_export)
                                    <form action="{{route('indi_export.setnum', $indi_export->id)}}" id="IndiExportSetNumForm" method="post" accept-charset="utf-8" class="form-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="{{empty($indi_export->permission_num)?'hidden':'date'}}" name="permission_date" value="{{$indi_export->permission_date}}"
                                               class="form-control">
                                        <input type="{{empty($indi_export->permission_num)?'hidden':'text'}}" name="permission_num" value="{{$indi_export->permission_num}}"
                                               class="form-control" placeholder="№" style="width:100px">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i> {{empty($indi_export->permission_num)?'Назнчить номер':''}}
                                            </button>
                                        </div>
                                    </form>
                                @endcan
                            </div>
                            <div style="float: left; padding-left:10px">
                                <a href="{{route('indi_export.permission_doc', $indi_export->id)}}" class="btn btn-primary" alt="Разрешение">
                                    <i class="fa fa-file-word-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                        <td class="table-text">
                            от <u>{{empty($indi_export->request_date)?str_repeat('&nbsp;',20):$indi_export->request_date}}</u>
                            № <u>{{empty($indi_export->request_num)?str_repeat('&nbsp;', 6):$indi_export->request_num}}</u>
                        </td>
                        <td>
                            @can('update', $indi_export)
                                <form action="{{route('indi_export.destroy', $indi_export->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-primary">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        Удалить
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endcan
              @endforeach
            </tbody>
          </table>
          {{$indi_exports->links()}}
        </div>
    </div>
    @endif
@endsection
