@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="{{route('institution.store')}}" class="form-inline text-right" id="InstitutionAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="institution-name" class="form-control" placeholder="Название..."
                   maxlength="255" type="text" style="width:300px">
        </div>
        <div class="form-group required">
            <input name="index" id="institution-index" class="form-control" placeholder="Индекс..."
                   maxlength="3" type="text" style="width:100px">
        </div>
        <div class="form-group required">
            <select name="region_id" id="institution-region_id" class="form-control">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}">{{$region}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <select name="organ_id" id="institution-organ_id" class="form-control">
                @foreach ($organs as $id => $organ)
                    <option value="{{$id}}">{{$organ}}</option>
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
                <th>Код</th>
                <th>Название</th>
                <th>Удалить</th>
            </thead>

            <tbody>
            @foreach ($institutions as $institution)
                <tr>
                    <td class="table-text">
                        <a class="btn btn-primary" href="{{route('institution.edit', $institution->id)}}">{{$institution->id}}</a>
                    </td>
                    <td class="table-text">
                        <form class="form-inline" action="{{route('institution.update', $institution->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group required">
                                <input name="name" class="form-control" value="{{ $institution->name }}" maxlength="255" type="text" style="width:300px">
                            </div>
                            <div class="form-group required">
                                <input name="index" class="form-control" value="{{ $institution->index }}" maxlength="2" type="text" style="width:50px">
                            </div>
                            <div class="form-group required">
                                <select name="region_id" id="institution-region_id" class="form-control">
                                    @foreach ($regions as $id => $region)
                                        <option value="{{$id}}" {{$institution->region_id == $id ? 'selected' : ''}}>{{$region}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group required">
                                <select name="organ_id" id="institution-organ_id" class="form-control">
                                    @foreach ($organs as $id => $organ)
                                        <option value="{{$id}}" {{$institution->organ_id == $id ? 'selected' : ''}}>{{$organ}}</option>
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
                        <form action="{{route('institution.destroy', $institution->id)}}" method="POST">
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
        {{$institutions->links()}}
      </div>
    </div>
   @endif
@endsection
