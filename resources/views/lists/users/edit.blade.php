@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

<form action="{{route('user.update', $user->id)}}" class="well" id="UserEditForm" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset>
		<legend>Редактирование пользователя</legend>
		<div class="form-group required">
            <label for="username">Логин</label>
            <input name="username" class="form-control" maxlength="50" type="text"
                   id="username" required="required" value="{{ $user->username }}">
        </div>
        <div class="form-group required">
            <label for="displayname">ФИО</label>
            <input name="displayname" class="form-control" maxlength="50" type="text"
                   id="displayname" required="required" value="{{ $user->displayname }}">
        </div>
        <div class="form-group required">
            <label for="user-role_id">Роль</label>
            <select name="role_id" id="user-role_id" class="form-control">
                @foreach ($roles as $id => $role)
                    <option value="{{$id}}" {{$user->role_id == $id ? 'selected' : ''}}>{{$role}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user-institution_id">Учреждение</label>
            <select name="institution_id" id="user-institution_id" class="form-control">
                @foreach ($institutions as $id => $institution)
                    <option value="{{$id}}" {{$user->institution_id == $id ? 'selected' : ''}}>{{$institution}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="allow_individual">Работа с физ. лицами</label>
            <select name="allow_individual" id="user-allow_individual" class="form-control">
                <option value="0" {{ !$user->allow_individual? 'selected' : ''}}>Нет</option>
                <option value="1" {{ $user->allow_individual? 'selected' : ''}}>Да</option>
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>
<br/>
<form action="{{route('user.storage.store', $user->id)}}" class="form-inline" id="StorageAddForm" method="POST" accept-charset="utf-8">
    {{ csrf_field() }}
    <div class="form-group required">
        <select name="storage_id" id="user_storage-storage_id" class="form-control" style="width:300px;">
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
@if (count($user->storages) > 0)
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
        @foreach ($user->storages as $storage)
          <tr>
            <td>
                {{ $storage->name }}
            </td>
            <td>
                <form action="{{route('user.storage.destroy', ['user'=>$user->id, 'storage'=>$storage->id])}}" method="POST">
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
    $('#user_storage-storage_id').selectize({
		create: false,
		persist: false,
		selectOnTab: true,
        placeholder: 'база хранения'
	});
});
</script>
@endsection
