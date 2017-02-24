@extends('layouts.app')

@section('styles')
<link href="{{ URL::asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ URL::asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
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
            <label for="storage">Место хранения</label>
            <select name="storage_id" id="storage" class="form-control" >
                <option value=""></option>
                @foreach ($storages as $id => $storage)
                    <option value="{{$id}}">{{$storage}}</option>
                @endforeach
            </select>
        </div>
        @if(Gate::allows('specify-export-permission', null))
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
            <label for="district">Район происхождения</label>
            <select name="district_id" id="district" class="form-control" >
                <option value=""></option>
                @foreach ($districts as $id => $district)
                    <option value="{{ $id }}">{{$district}}</option>
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
    $('select[name="organization_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'организация'
	});
    $('select[name="storage_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'место хранения'
	});
    $('select[name="purpose_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'цель вывоза'
	});
    $('select[name="district_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'район происхождения'
	});
    $('select[name="transport_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'транспорт'
	});
    $('select[name="region_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'регион ввоза'
	});
});
</script>
@endsection
