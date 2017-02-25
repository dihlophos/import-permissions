@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('institution.update', $institution->id)}}" class="well" id="InstitutionEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование учреждения</legend>
		<div class="form-group required">
            <label for="InstitutionName">Название</label>
            <input name="name" class="form-control" maxlength="50" type="text"
                   id="InstitutionName" required="required" value="{{ $institution->name }}">
        </div>
        <div class="form-group required">
            <label for="institution-region_id">Название</label>
            <select name="region_id" id="institution-region_id" class="form-control">
                @foreach ($regions as $id => $region)
                    <option value="{{$id}}" {{$institution->region_id == $id ? 'selected' : ''}}>{{$region}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="{{route('institution.district.store', $institution->id)}}" class="form-inline" id="DistrictAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <select name="district_id" id="institution_district-district_id" class="form-control" style="width:300px;">
            <option value=""></option>
            @foreach ($districts as $id => $district)
                <option value="{{$id}}">{{$district}}</option>
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
@if (count($institution->districts) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
    Районы
  </div>

  <div class="panel-body">
    <table class="table table-striped task-table">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($institution->districts as $district)
          <tr>
            <td class="table-text">
                {{ $district->name }}
            </td>
            <td>
                <form action="{{route('institution.district.destroy', ['$institution'=>$institution->id, 'district'=>$district->id])}}" method="POST">
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
  </div>
</div>
@endif
@endsection

@section('scripts')
<script src="{{ asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('#institution_district-district_id').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'район'
	});
});
</script>
@endsection
