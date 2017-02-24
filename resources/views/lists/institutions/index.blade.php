@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="{{route('institution.store')}}" class="form-inline text-right" id="InstitutionAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="institution-name" class="form-control" placeholder="Название..."
                   maxlength="255" type="text" style="width:600px">
        </div>
        <div class="form-group required">
            <select name="region_id" id="institution-region_id" class="form-control">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}">{{$region}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($institutions) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Учреждения
      </div>

      <div class="panel-body">
        {{$institutions->links()}}
        <table class="table table-striped task-table">

            <thead>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

          <tbody>
            @foreach ($institutions as $institution)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="{{route('institution.update', $institution->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $institution->name }}" maxlength="255" type="text" style="width:500px">
                        </div>
                        <div class="form-group required">
                            <select name="region_id" id="institution-region_id" class="form-control">
                                @foreach ($regions as $id => $region)
                                    <option value="{{$id}}" {{$institution->region_id == $id ? 'selected' : ''}}>{{$region}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="{{route('institution.destroy', $institution->id)}}" method="POST">
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
        {{$institutions->links()}}
      </div>
    </div>
   @endif
@endsection
