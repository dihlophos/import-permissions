@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/organization" class="form-inline text-right" id="OrganizationAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="organization-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <input name="tin" id="organization-tin" class="form-control" placeholder="ИНН..." maxlength="255" type="number" style="width:200px">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($organizations) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Организации
      </div>

      <div class="panel-body">
        {{$organizations->links()}}
        <table class="table table-striped task-table">

          <thead>
              <th>Код</th>
              <th>Название</th>
              <th>ИНН</th>
              <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($organizations as $organization)
              <tr>
                <td class="table-text">
                    <a class="btn btn-primary" href="{{route('organization.edit', $organization->id)}}">{{$organization->id}}</a>
                </td>
                <td class="table-text" colspan="2">
                    <form class="form-inline" action="/lists/organization/{{ $organization->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $organization->name }}" maxlength="255" type="text" style="width:600px">
                        </div>
                        <div class="form-group required">
                            <input name="tin" class="form-control" value="{{ $organization->tin }}" maxlength="255" type="number" style="width:200px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/organization/{{ $organization->id }}" method="POST">
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
        {{$organizations->links()}}
      </div>
    </div>
   @endif
@endsection
