@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <a href="{{route('export.create')}}" class="btn btn-primary" role="button">Добавить</a><br/><br/>
    @if (count($exports) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
          Вывоз
        </div>

        <div class="panel-body">
          {{$exports->links()}}
          <table class="table table-striped task-table">
            <thead>
                <th>Код</th>
                <th>Разрешение</th>
                <th>На заявку</th>
                <th>Удалить</th>
            </thead>
            <tbody>
              @foreach ($exports as $export)
                <tr>
                    <td class="table-text">
                        <a href="{{route('export.edit', $export->id)}}" class="btn btn-primary" role="button">{{$export->id}}</a>
                        <a href="{{route('export.process', $export->id)}}" class="btn btn-primary" role="button">Выполнение</a>
                    </td>
                    <td class="table-text">
                        <div style="float: left;">
                            от <u>{{empty($export->permission_date)?str_repeat('&nbsp;',20):$export->permission_date}}</u>
                            № <u>{{empty($export->permission_num)?str_repeat('&nbsp;', 6):$export->permission_num}}</u>
                        </div>
                        <div style="float: left; padding-left:10px">
                            <form action="{{route('export.update', $export->id)}}" id="ExportEditForm" method="post" accept-charset="utf-8" class="form-inline">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="organization_id" value="{{$export->organization_id}}">
                                <input type="hidden" name="storage_id" value="{{$export->storage_id}}">
                                <input type="hidden" name="permission_date" value="{{$export->permission_date}}">
                                <input type="hidden" name="request_date" value="{{$export->request_date}}">
                                <input type="hidden" name="request_num" value="{{$export->request_num}}">
                                <input type="hidden" name="purpose_id" value="{{$export->purpose_id}}">
                                <input type="hidden" name="district_id" value="{{$export->district_id}}">
                                <input type="hidden" name="transport_id" value="{{$export->transport_id}}">
                                <input type="hidden" name="region_id" value="{{$export->region_id}}">
                                <input type="hidden" name="address" value="{{$export->address}}">
                                <input type="text" name="permission_num" value="{{$export->permission_num}}"
                                       class="form-control" placeholder="№" style="width:100px">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </td>
                    <td class="table-text">
                        от <u>{{empty($export->request_date)?str_repeat('&nbsp;',20):$export->request_date}}</u>
                        № <u>{{empty($export->request_num)?str_repeat('&nbsp;', 6):$export->request_num}}</u>
                    </td>
                    <td>
                        <form action="{{route('export.destroy', $export->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-primary">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{$exports->links()}}
        </div>
    </div>
    @endif
@endsection
