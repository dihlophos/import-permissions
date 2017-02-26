@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('organization.update', $organization->id)}}" class="well" id="OrganizationEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование организации</legend>
		<div class="form-group required">
            <label for="organization-name">Название</label>
            <input name="name" id="organization-name" class="form-control" value="{{ $organization->name }}"
                   placeholder="Название..." maxlength="255" type="text" required="required">
        </div>
        <div class="form-group required">
            <label for="organization-tin">ИНН</label>
            <input name="tin" id="organization-tin" class="form-control" value="{{ $organization->tin }}"
            placeholder="ИНН..." maxlength="255" type="number" style="width:200px">
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>

<form action="{{route('organization.storage.store', $organization->id)}}" class="form-inline" id="StorageAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <select name="storage_id" id="organization_storage-storage_id" class="form-control" style="width:300px;">
            <option value=""></option>
            @foreach ($storages as $id => $storages)
                <option value="{{$id}}">{{$storages}}</option>
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
@if (count($organization->storages) > 0)
<div class="panel panel-default">
  <div class="panel-heading">
    Базы хранения
  </div>

  <div class="panel-body">
    <table class="table table-striped">

      <thead>
        <th>Название</th>
        <th>Удалить</th>
      </thead>

      <tbody>
        @foreach ($organization->storages as $storage)
          <tr>
            <td>
                {{ $storage->name }}
            </td>
            <td>
                <form action="{{route('organization.storage.destroy', ['organization'=>$organization->id, 'storage'=>$storage->id])}}" method="POST">
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
    $('#organization_storage-storage_id').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'база хранения'
	});
});
</script>
@endsection
