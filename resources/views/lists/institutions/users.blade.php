@extends('layouts.app')
@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')

  @if (count($users) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Пользователи учреждения: {{$institution->name}}
      </div>

      <div class="panel-body">
        {{$users->links()}}
        <table class="table table-striped">

            <thead>
                <th style="width:150px">ФИО</th>
                <th style="width:150px">Роль</th>
                <th>Базы хранения</th>
            </thead>

            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="table-text">
                        {{ $user->displayname }}
                    </td>
                    <td class="table-text">
                        @if (!is_null($user->role))
                            {{ $user->role->name }}
                        @endif
                    </td>
                    <td>
                        <select multiple name="storage[]">
                            @foreach ($storages as $id => $storage)
                            <option {{$user->storages->contains('id', $id) ? 'selected' : ''}} value="{{$id}}">{{$storage}}</option>
                            @endforeach
                        </select>
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

@section('scripts')
<script src="{{ asset('/js/selectize.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('select').selectize({
        valueField: 'id',
        labelField: 'name'
    });
});
</script>
@endsection
