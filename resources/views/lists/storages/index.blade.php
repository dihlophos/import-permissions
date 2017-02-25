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
            <input name="district_id" id="storage-district_id" class="form-control" placeholder="Район..." style="width:260px">
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
        <table class="table table-striped task-table">

          <thead>
              <th>Название</th>
              <th>Удалить</th>
          </thead>

          <tbody>
            @foreach ($storages as $storage)
              <tr>
                <td class="table-text">
                    <form class="form-inline" action="/lists/storage/{{ $storage->id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            <input name="name" class="form-control" value="{{ $storage->name }}" maxlength="255" type="text" style="width:200px">
                        </div>
                        <div class="form-group required">
                            <input name="address" class="form-control" value="{{ $storage->address }}" maxlength="255" type="text" style="width:500px">
                        </div>
                        <div class="form-group required">
                            <input name="district_id" id="storage-district_id" value="{{$storage->district_id}}" class="form-control" placeholder="Район..." style="width:260px">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </td>
                <td>
                    <form action="/lists/storage/{{ $storage->id }}" method="POST">
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
		selectOnTab: true,
        valueField: 'value',
        labelField: 'name',
        searchField: 'name',
        placeholder: 'Район',
        options:[
            @foreach ($districts as $id => $district)
            {value: {{$id}}, name: '{!! $district !!}'},
            @endforeach
        ]
	});
});
</script>
@endsection
