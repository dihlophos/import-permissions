@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <a href="{{route('export.create')}}" class="btn btn-info" role="button">Добавить</a><br/><br/>
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
                        {{$export->id}}
                    </td>
                    <td class="table-text">
                        от <u>{{empty($export->rermission_date)?str_repeat('&nbsp;',20):$export->rermission_date}}</u>
                        № <u>{{empty($export->permission_num)?str_repeat('&nbsp;', 6):$export->permission_num}}</u>
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
