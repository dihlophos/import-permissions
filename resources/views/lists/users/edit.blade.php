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
            <input class="btn btn-default" type="submit" value="Сохранить">
        </div>
    </fieldset>
</form>
@endsection