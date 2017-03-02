@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="/lists/storage" class="form-inline" id="StorageAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="name" id="storage-name" class="form-control" placeholder="Название..." maxlength="255" type="text" style="width:200px">
        </div>
        <div class="form-group required">
            <input name="address" id="storage-address" class="form-control" placeholder="Адрес..." maxlength="255" type="text" style="width:450px">
        </div>
        <div class="form-group required">
            <input name="district_id" id="storage-district_id" class="form-control perm-districts" placeholder="Район..." style="width:260px">
            <!--select name="district_id" id="storage-district_id" class="form-control" placeholder="район" style="width:260px">
                <option value=""></option>

            </select-->
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i> Добавить
            </button>
        </div>
    </form>
    <br/>
  @if (count($storages) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Базы хранения
      </div>

      <div class="panel-body">
        {{$storages->links()}}

        <div class="row">
            <div class="col-md-3">
                <b>Название</b>
            </div>
            <div class="col-md-4">
                <b>Адрес</b>
            </div>
            <div class="col-md-3">
                <b>Район</b>
            </div>
            <div class="col-md-1">
                <b>Сохранить</b>
            </div>
            <div class="col-md-1">
                <b>Удалить</b>
            </div>
        </div>
        @foreach ($storages as $storage)
        <div class="row perm-form-row">
            <form class="form-inline" action="/lists/storage/{{ $storage->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-md-3">
                    <input name="name" class="form-control" value="{{ $storage->name }}" maxlength="255" type="text" style="width:100%">
                </div>
                <div class="col-md-4">
                    <textarea name="address" class="form-control" maxlength="255" type="text" style="width:100%;height:75px;">{{ $storage->address }}</textarea>
                </div>
                <div class="col-md-3">
                    <input name="district_id" id="storage-district_id" value="{{$storage->district_id}}" class="form-control perm-districts" placeholder="Район..." style="width:100%">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" style="width:100%">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
            <div class="col-md-1">
            <form action="/lists/storage/{{ $storage->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button class="btn btn-primary" style="width:100%">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
            </form>
            </div>
        </div>
        @endforeach
        {{$storages->links()}}
      </div>
    </div>
   @endif
@endsection

@section('scripts')
<script src="{{ asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('input[name=district_id]').selectize({
		create: false,
		persist: false,
        multiple: false,
		selectOnTab: true,
        valueField: 'value',
        labelField: 'name',
        searchField: 'name',
        placeholder: 'Район',
        options:[
            @foreach ($districts as $district)
            {value: {{$district->id}}, name: '{!! $district->name !!}', region:'{!! $district->region->name !!}'},
            @endforeach
        ],
        render: {
            item: function(item, escape) {
                return '<div>' +
                    (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
                    (item.region ? '<span class="region">(' + escape(item.region) + ')</span>' : '') +
                '</div>';
            },
            option: function(item, escape) {
                var label = item.name || item.region;
                var caption = item.name ? item.region : null;
                return '<div>' +
                    '<span >' + escape(label) + '</span>' +
                    (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                '</div>';
            }
        }
	});
});
</script>
@endsection
