@extends('layouts.app')

@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('export.store')}}" class="well" id="ExportAddForm" method="post" accept-charset="utf-8" class="form-horizontal">
    {{ csrf_field() }}
    <fieldset>
		<legend>Вывоз</legend>
		<div class="form-group required">
            <label for="organization">Организация</label>
            <select name="organization_id" id="organization" class="form-control">
                <option value=""></option>
                @foreach ($organizations as $id => $org)
                    <option value="{{$id}}">{{$org}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <label for="district">Район происхождения</label>
            <select name="district_id" id="district" class="form-control" >
                <option value=""></option>
                @foreach ($districts as $id => $district)
                    <option value="{{ $id }}">{{$district}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <label for="storage">Место хранения</label>
            <select name="storage_id" id="storage" class="form-control" >
            </select>
        </div>
        @if(Gate::allows('specify-export-permission', $institution_id))
            <div class="form-group required">
                <label class="col-sm-2" for="permission_date">Разрешение от</label>
                <label class="col-sm-10" for="permission_num">№</label>
                <div class="col-sm-2"><input type="date" name="permission_date" class="form-control" value={{date("Y-m-d")}}></div>
                <div class="col-sm-10" style="margin-bottom:15px;"><input type="text" name="permission_num" class="form-control" placeholder="№" style="width:300px"></div>
            </div>
        @endif
        <div class="form-group required">
            <label class="col-sm-2" for="request_date">На заявку от</label>
            <label class="col-sm-10" for="request_num">№</label>
            <div class="col-sm-2"><input type="date" name="request_date" class="form-control" value={{date("Y-m-d")}}></div>
            <div class="col-sm-10" style="margin-bottom:15px;"><input type="text" name="request_num" class="form-control" placeholder="№" style="width:300px"></div>
        </div>
        <div class="form-group required">
            <label for="purpose">Цель вывоза</label>
            <select name="purpose_id" id="purpose" class="form-control" >
                <option value=""></option>
                @foreach ($purposes as $id => $purpose)
                    <option value="{{ $id }}">{{$purpose}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group required">
            <label for="transport">Транспорт</label>
            <select name="transport_id" id="transport" class="form-control" >
                <option value=""></option>
                @foreach ($transports as $id => $transport)
                    <option value="{{ $id }}">{{$transport}}</option>
                @endforeach
            </select>
        </div>
        <fieldset>
            <legend>Ввоз</legend>
            <div class="form-group required">
                <label for="region">Регион ввоза</label>
                <select name="region_id" id="region" class="form-control" >
                    <option value=""></option>
                    @foreach ($regions as $id => $region)
                        <option value="{{ $id }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="dest_district">Район ввоза</label>
                <select name="dest_district_id" id="dest_district" class="form-control" placeholder="район">
                </select>
            </div>
            <div class="form-group required">
                <label for="address">Адрес</label>
                <input name="address" id="address" class="form-control" type="text" placeholder="адрес">
            </div>
            <div class="form-group">
                <input class="btn btn-default" type="submit" value="Сохранить">
            </div>
            <input type='hidden' name="institution_id" value="{{ $institution_id }}">
        </fieldset>
    </fieldset>
</form>
@endsection

@section('scripts')
<script src="{{ URL::asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    var xhr;
    $('select[name="purpose_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'цель вывоза'
	});
    $('select[name="transport_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'транспорт'
	});

    var select_storage, $select_storage;
    var select_org, $select_org;
    var select_district, $select_district;
    $select_org = $('select[name="organization_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'организация',
        onChange: function(value) {
			//value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_storage.disable();
			select_storage.clearOptions();
            if (!value.length || !select_district.selected_value || !select_district.selected_value.length ) return;
			select_storage.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/storages?organization=' + select_org.selected_value + '&district=' + select_district.selected_value,
					success: function(results) {
						select_storage.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});
    $select_district = $('select[name="district_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'район происхождения',
        onChange: function(value) {
			//value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_storage.disable();
			select_storage.clearOptions();
            if (!value.length || !select_org.selected_value || !select_org.selected_value.length) return;
			select_storage.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/storages?organization=' + select_org.selected_value + '&district=' + select_district.selected_value,
					success: function(results) {
						select_storage.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});
    $select_storage = $('select[name="storage_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'место хранения',
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        plugins: ['restore_on_backspace'],
        onInitialize: function() {this.selected_value = this.getValue();},
        onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
        onDropdownClose: function($dropdown) {
            if(this.getValue()==0) {
                this.setValue(this.selected_value );
            }
        }
	});

    select_org  = $select_org[0].selectize;
    select_district  = $select_district[0].selectize;
    select_storage  = $select_storage[0].selectize;

    select_storage.disable();

	var select_region, $select_region;
	var select_dest_district, $select_dest_district;
    $select_region = $('select[name="region_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'регион ввоза',
        // предотвращение очистки поля
        // onInitialize: function() {this.selected_value = this.getValue();},
		// onDropdownClose: function($dropdown) {
		// 	if(this.getValue()==0) {
		// 		this.setValue(this.selected_value );
		// 	}
		// },
        onChange: function(value) {
			//value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_dest_district.disable();
			select_dest_district.clearOptions();
            if (!value.length) return;
			select_dest_district.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'get',
					url: '/api/regions/' + select_region.selected_value + '/districts',
					success: function(results) {
						select_dest_district.enable();
						callback(results);
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

    $select_dest_district = $('#dest_district').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		}
	});

	select_dest_district  = $select_dest_district[0].selectize;
	select_region = $select_region[0].selectize;

	select_dest_district.disable();
});
</script>
@endsection
