@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/organ" class="form-inline text-right" id="OrganAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="organ-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:350px">
        </div>
        <div class="form-group required">
            <input name="head_name" id="organ-head_name" class="form-control" placeholder="И. О. Фамилия руководителя..." maxlength="150" type="text" style="width:350px">
        </div>
        <div class="form-group required">
            <input name="head_job" id="organ-head_job" class="form-control" placeholder="Должность руководителя..." maxlength="150" type="text" style="width:350px">
        </div>
        <br/>
        <div class="form-group required">
            <select name="region_id" id="organ-region_id" class="form-control">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}">{{$region}}</option>
                @endforeach
            </select>
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
        Управления
      </div>

      <div class="panel-body">
        {{$organs->links()}}
        <table class="table table-striped task-table">

          <thead>
              <th style="width:250px">Название</th>
              <th style="width:250px">И. О. Фамилия руководителя</th>
              <th style="width:250px">Должность руководителя</th>
              <th style="width:280px">Регион</th>
              <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($organs as $organ)
              <tr>
                <td class="table-text" colspan="4">
                    <form class="form-inline" action="/lists/organ/{{ $organ->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $organ->name }}" maxlength="255" type="text" style="width:240px">
                        </div>
                        <div class="form-group required">
                            <input name="head_name" id="organ-head_name" value="{{ $organ->head_name }}" class="form-control" placeholder="И. О. Фамилия руководителя..." maxlength="150" type="text" style="width:230px">
                        </div>
                        <div class="form-group required">
                            <input name="head_job" id="organ-head_job" value="{{ $organ->head_job }}" class="form-control" placeholder="Должность руководителя..." maxlength="150" type="text" style="width:240px">
                        </div>
                        <div class="form-group required">
                            <select name="region_id" id="organ-region_id" class="form-control"  style="width:250px">
                                @foreach ($regions as $id => $region)
                                    <option value="{{$id}}" {{$organ->region_id == $id ? 'selected' : ''}}>{{$region}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
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
