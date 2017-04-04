@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

    <form action="{{route('user.store')}}" class="form-inline text-right" id="UserAddForm" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="form-group required">
            <input name="username" id="user-username" class="form-control" placeholder="Логин"
                   maxlength="255" type="text">
        </div>
        <div class="form-group required">
            <input name="displayname" id="user-displayname" class="form-control" placeholder="ФИО"
                   maxlength="255" type="text">
        </div>
        <div class="form-group required">
            <input name="password" id="user-password" class="form-control" placeholder="Пароль"
                   maxlength="255" type="password">
        </div>
        <div class="form-group">
            <input name="email" id="user-email" class="form-control" placeholder="E-mail"
                   maxlength="255" type="email">
        </div>
        <div class="form-group required">
            <select name="role_id" id="user-role_id" class="form-control">
                @foreach ($roles as $id => $role)
                    <option value="{{$id}}">{{$role}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="institution_id" id="user-institution_id" class="form-control">
                @foreach ($institutions as $id => $institution)
                    <option value="{{$id}}">{{$institution}}</option>
                @endforeach
            </select>
        </div>
        <input name="allow_individual" type="hidden" value="0"/>
        <br/>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">
            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
        </button>
    </form>
    <br/>
  @if (count($users) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Пользователи
      </div>

      <div class="panel-body">
        {{$users->links()}}
        <table class="table table-striped">

            <thead>
                <th>Логин</th>
                <th>ФИО</th>
                <th>E-mail</th>
                <th>Роль</th>
                <th>Учреждение</th>
                <th>Работа с физ. лицами</th>
                <th>Удалить</th>
            </thead>

            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="table-text">
                         <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary" role="button">{{ $user->username }}</a>
                    </td>
                    <td class="table-text">
                        {{ $user->displayname }}
                    </td>
                    <td class="table-text">
                        {{ $user->email }}
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->role))
                            {{ $user->role->name }}
                        @endif
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->institution))
                            {{ $user->institution->name }}
                        @endif
                    </td>
                    <td class="table-text">
                        {{ $user->allow_individual?"Да":"Нет" }}
                    </td>
                    <td>
                        <form action="{{route('user.destroy', $user->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-primary">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                Нет пользователей О_о
            @endforelse
            </tbody>
        </table>
        {{$users->links()}}
      </div>
    </div>
   @endif
@endsection
