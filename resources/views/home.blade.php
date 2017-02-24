@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Сводка</div>

                <div class="panel-body">
                     <p>Здравствуйте, {{ Auth::user()->displayname }}!</p>
                     <p>Роль: {{ Auth::user()->RoleName() }}</p>
                     <p>Права администратора: {{ Auth::user()->isAdmin()?'да':'нет' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
