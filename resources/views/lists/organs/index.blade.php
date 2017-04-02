@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/organ" class="form-inline text-right" id="OrganAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="organ-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:800px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($organs) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Транспорт
      </div>

      <div class="panel-body">
        {{$organs->links()}}
        <table class="table table-striped task-table">

          <thead>
              <th>Название</th>
              <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($organs as $organ)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/organ/{{ $organ->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $organ->name }}" maxlength="255" type="text" style="width:800px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/organ/{{ $organ->id }}" method="POST">
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
        {{$organs->links()}}
      </div>
    </div>
   @endif
@endsection
