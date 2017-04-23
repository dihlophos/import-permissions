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
            <div class="row">
                <div class="col-md-2"><b>ФИО</b></div>
                <div class="col-md-2"><b>Роль</b></div>
                <div class="col-md-8"><b>Базы хранения</b></div>
            </div>

            @forelse ($users as $user)
            <div class="row">
                <div class="col-md-2">
                    {{ $user->displayname }}
                </div>
                <div class="col-md-2">
                    @if (!is_null($user->role))
                        {{ $user->role->name }}
                    @endif
                </div>
                <form action="{{route('user.storage.update', $user->id)}}" method="POST" id="UserStorageForm" accept-charset="utf-8">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                <div class="col-md-7">
                    <select multiple name="storage[]">
                        @foreach ($storages as $id => $storage)
                            <option {{$user->storages->contains('id', $id) ? 'selected' : ''}} value="{{$id}}">{{$storage}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" style="width:100%">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

                </form>
            @empty
                Нет пользователей О_о
            @endforelse
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
