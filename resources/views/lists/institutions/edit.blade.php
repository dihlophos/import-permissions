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
            <label for="institution-region_id">Регион</label>
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
                    <form action="{{route('institution.district.destroy', ['institution'=>$institution->id, 'district'=>$district->id])}}" method="POST">
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

    var district_xhr;
	var select_region, $select_region;
	var select_district, $select_district;

    $select_region = $('#institution-region_id').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'регион',
        //предотвращение очистки поля
        onInitialize: function() {
            this.selected_value = this.getValue();
        },
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
        onChange: function(value) {
			value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_district.disable();
			select_district.clearOptions();
            if (!value.length) return;
			select_district.load(function(callback) {
				district_xhr && district_xhr.abort();
				district_xhr = $.ajax({
					type: 'get',
					url: '/api/regions/' + select_region.selected_value + '/districts',
					success: function(results) {
						select_district.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

    select_region = $select_region[0].selectize;

    $select_district = $('#institution_district-district_id').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
        placeholder: 'район',
        onInitialize: function() {
            this.selected_value = this.getValue();
            this.load(function(callback) {
				district_xhr && district_xhr.abort();
				district_xhr = $.ajax({
					type: 'get',
					url: '/api/regions/' + select_region.selected_value + '/districts',
					success: function(results) {
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
        },
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		}
	});

	select_district  = $select_district[0].selectize;
});
</script>
@endsection
