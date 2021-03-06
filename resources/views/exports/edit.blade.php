@extends('layouts.app')

@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('export.update', $export->id)}}" class="well" id="ExportEditForm" method="post" accept-charset="utf-8" class="form-horizontal">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="panel panel-info">
		<div class="panel-heading" role="button" data-toggle="collapse" data-target="#exportFields" aria-expanded="false">
			<h3 class="panel-title">Вывоз</h3>
		</div>
		<div class="panel-body collapse" id="exportFields">
    		<div class="form-group required">
                <label for="organization">Организация</label>
                <select name="organization_id" id="organization" class="form-control">
                    <option value=""></option>
                    @foreach ($organizations as $id => $org)
                        <option value="{{$id}}" {{$export->organization_id==$id?'selected':''}}>{{$org}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="district">Район происхождения</label>
                <select name="district_id" id="district" class="form-control" >
                    <option value=""></option>
                    @foreach ($districts as $id => $district)
                        <option value="{{$id}}" {{$export->district_id==$id?'selected':''}}>{{$district}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="storage">Место хранения</label>
                <select name="storage_id" id="storage" class="form-control" >
                    <option value="{{$export->storage_id}}">{{$export->storage->name}}</option>
                    <!--
                    <option value=""></option>
                    @foreach ($storages as $id => $storage)
                        <option value="{{$id}}" {{$export->storage_id==$id?'selected':''}}>{{$storage}}</option>
                    @endforeach
                    -->
                </select>
            </div>
            @if(Gate::allows('specify-export-permission', $export->institution_id))
                <div class="form-group required">
                    <label class="col-sm-2" for="permission_date">Разрешение от</label>
                    <label class="col-sm-10" for="permission_num">№</label>
                    <div class="col-sm-2">
                        <input type="date" name="permission_date" class="form-control" value="{{$export->permission_date}}">
                    </div>
                    <div class="col-sm-10" style="margin-bottom:15px;">
                        <input type="text" name="permission_num" value="{{$export->permission_num}}"
                               class="form-control" placeholder="№" style="width:300px">
                     </div>
                </div>
            @endif
            <div class="form-group required">
                <label class="col-sm-2" for="request_date">На заявку от</label>
                <label class="col-sm-10" for="request_num">№</label>
                <div class="col-sm-2">
                    <input type="date" name="request_date" class="form-control" value="{{$export->request_date}}">
                </div>
                <div class="col-sm-10" style="margin-bottom:15px;">
                    <input type="text" name="request_num" value="{{$export->request_num}}"
                           class="form-control" placeholder="№" style="width:300px">
                </div>
            </div>
            <div class="form-group required">
                <label for="purpose">Цель вывоза</label>
                <select name="purpose_id" id="purpose" class="form-control" >
                    <option value=""></option>
                    @foreach ($purposes as $id => $purpose)
                        <option value="{{$id}}" {{$export->purpose_id==$id?'selected':''}}>{{$purpose}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="transport">Транспорт</label>
                <select name="transport_id" id="transport" class="form-control" >
                    <option value=""></option>
                    @foreach ($transports as $id => $transport)
                        <option value="{{$id}}" {{$export->transport_id==$id?'selected':''}}>{{$transport}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
		<div class="panel-heading" role="button" data-toggle="collapse" data-target="#importFields" aria-expanded="false">
			<h3 class="panel-title">Ввоз</h3>
		</div>
		<div class="panel-body collapse" id="importFields">
            <div class="form-group required">
                <label for="region">Регион ввоза</label>
                <select name="region_id" id="region" class="form-control" >
                    <option value=""></option>
                    @foreach ($regions as $id => $region)
                        <option value="{{$id}}" {{$export->region_id==$id?'selected':''}}>{{$region}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="dest_district">Район ввоза</label>
                <select name="dest_district_id" id="dest_district" class="form-control" placeholder="район">
                    <option value="{{$export->dest_district_id}}">{{$export->dest_district->name}}</option>
                </select>
            </div>
            <div class="form-group required">
                <label for="address">Адрес</label>
                <input name="address" id="address" class="form-control" value="{{$export->address}}" type="text" placeholder="адрес">
            </div>
        </div>
    </div>
    <input type="hidden" name="institution_id" value="{{ $export->institution_id }}">
    <div class="form-group">
        <input class="btn btn-default" type="submit" value="Сохранить">
    </div>
</form>

<form action="{{route('exported_product.store')}}" class="form-inline" id="ExportedProductAddForm" method="post" accept-charset="utf-8" class="form-horizontal">
    {{ csrf_field() }}
    <input name="export_id" type="hidden" value="{{$export->id}}">
    <div class="form-group">
        <label class="sr-only" for="product_type">Груз</label>
        <select name="product_type_id" id="product_type" class="form-control" placeholder="груз">
            @foreach ($product_types as $id => $product_type)
                <option value="{{$id}}">{{$product_type}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="sr-only" for="measure">Ед изм</label>
        <select name="measure" id="measure" class="form-control" placeholder="груз">
            <option value="тонна">тонна</option>
            <option value="тыс.шт.">тыс.шт.</option>
        </select>
    </div>
    <div class="form-group">
        <label class="sr-only" for="count">Количество</label>
        <input name="count" class="form-control" id="count" type="number" placeholder="количество">
    </div>
    <div class="form-group">
        <label class="sr-only" for="manufacturer">Производитель</label>
        <input name="manufacturer" class="form-control" id="manufacturer" type="text" placeholder="производитель">
    </div>
    <div class="form-group">
        <input class="btn btn-info" type="submit" value="Добавить груз">
    </div>
</form>
<br/>

@if (count($exported_products) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Вывозимая продукция
    </div>

    <div class="panel-body">
        {{$exported_products->links()}}
        <table class="table table-striped task-table">
            <thead>
                <th>Груз</th>
                <th>Ед изм</th>
                <th>Количество</th>
                <th>Производитель</th>
                <th>Удалить</th>
            </thead>
            <tbody>
            @foreach ($exported_products as $product)
                <tr>
                    <td class="table-text" colspan="4">
                        <form action="{{route('exported_product.update', $product->id)}}" class="form-inline"
                              id="ExportedProductEditForm{{$product->id}}" method="post" accept-charset="utf-8" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input name="export_id" type="hidden" value="{{$export->id}}">
                            <div class="form-group">
                                <label class="sr-only" for="product_type">Груз</label>
                                <select name="product_type_id" id="product_type" class="form-control" placeholder="груз">
                                    @foreach ($product_types as $id => $product_type)
                                        <option value="{{$id}}" {{$product->product_type_id==$id?'selected':''}}>{{$product_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="measure">Ед изм</label>
                                <select name="measure" id="measure" class="form-control" placeholder="ед изм">
                                    <option value="тонна" {{$product->measure=='тонна'?'selected':''}}>тонна</option>
                                    <option value="тыс.шт." {{$product->measure=='тыс.шт.'?'selected':''}}>тыс.шт.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="count">Количество</label>
                                <input name="count" value="{{$product->count}}" class="form-control" id="count" type="number" placeholder="количество">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="manufacturer">Производитель</label>
                                <input name="manufacturer" value="{{$product->manufacturer}}" class="form-control" id="manufacturer" type="text" placeholder="производитель">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить
                                </button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('exported_product.destroy', $product->id)}}" method="POST">
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
        {{$exported_products->links()}}
  </div>
</div>
@endif

@endsection

@section('scripts')
<script src="{{ asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    var storage_xhr;
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
        onInitialize: function() {
            this.selected_value = this.getValue();
        },
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
        onChange: function(value) {
            console.log('select_org');
			//value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_storage.disable();
			select_storage.clearOptions();
            if (!value.length || !select_district.selected_value || !select_district.selected_value.length ) return;
			select_storage.load(function(callback) {
				storage_xhr && storage_xhr.abort();
				storage_xhr = $.ajax({
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
        onInitialize: function() {
            this.selected_value = this.getValue();
        },
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		},
        onChange: function(value) {
            console.log('$select_district');
			//value=value==0||value==''?this.selected_value:value;
            this.selected_value=value;
			select_storage.disable();
			select_storage.clearOptions();
            if (!value.length || !select_org.selected_value || !select_org.selected_value.length) return;
			select_storage.load(function(callback) {
				storage_xhr && storage_xhr.abort();
				storage_xhr = $.ajax({
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
    select_org  = $select_org[0].selectize;
    select_district  = $select_district[0].selectize;
    $select_storage = $('select[name="storage_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'место хранения',
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        plugins: ['restore_on_backspace'],
        onInitialize: function() {
            console.log('$select_storage');
            this.selected_value = this.getValue();
            this.load(function(callback) {
				storage_xhr && storage_xhr.abort();
				storage_xhr = $.ajax({
					type: 'get',
					url: '/api/storages?organization=' + select_org.selected_value + '&district=' + select_district.selected_value,
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

    select_storage  = $select_storage[0].selectize;

    var dest_district_xhr;
	var select_region, $select_region;
	var select_dest_district, $select_dest_district;

    $select_region = $('select[name="region_id"]').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        plugins: ['restore_on_backspace'],
        placeholder: 'регион ввоза',
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
			select_dest_district.disable();
			select_dest_district.clearOptions();
            if (!value.length) return;
			select_dest_district.load(function(callback) {
				dest_district_xhr && dest_district_xhr.abort();
				dest_district_xhr = $.ajax({
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

    select_region = $select_region[0].selectize;

    $select_dest_district = $('#dest_district').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
        onInitialize: function() {
            this.selected_value = this.getValue();
            this.load(function(callback) {
				dest_district_xhr && dest_district_xhr.abort();
				dest_district_xhr = $.ajax({
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

	select_dest_district  = $select_dest_district[0].selectize;


});
</script>
@endsection
