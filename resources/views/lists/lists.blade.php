@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <div class="panel panel-default">
        <div class="panel-heading">Справочники</div>
        <div class="panel-body">
            <ul>
               <li><a href="{{ route('user.index') }}">Пользователи</a></li>
               <li><a href="{{ route('organization.index') }}">Организации</a></li>
               <li><a href="{{ route('region.index') }}">Регионы/районы</a></li>
               <li><a href="{{ route('transport.index') }}">Транспорт</a></li>
               <li><a href="{{ route('purpose.index') }}">Цель вывоза</a></li>
               <li><a href="{{ route('product_type.index') }}">Виды грузов</a></li>
               <li><a href="{{ route('storage.index') }}">Базы хранения</a></li>
               <li><a href="{{ route('institution.index') }}">Учреждения</a></li>
            </ul>
        </div>
    </div>
@endsection
