@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <div class="panel panel-default">
        <div class="panel-heading">Справочники</div>
        <div class="panel-body">
            <ul>
               <li><a href="{{ URL::action('OrganizationController@index') }}">Организации</a></li>
               <li><a href="{{ URL::action('RegionController@index') }}">Регионы/районы</a></li>
               <li><a href="{{ URL::action('TransportController@index') }}">Транспорт</a></li>
               <li><a href="{{ URL::action('PurposeController@index') }}">Цель вывоза</a></li>
               <li><a href="{{ URL::action('ProductTypeController@index') }}">Виды грузов<a></li>
               <li><a href="{{ URL::action('StorageController@index') }}">Базы хранения</a></li>
               <li><a href="{{ route('institution.index') }}">Учреждения</a></li>
            </ul>
        </div>
    </div>
@endsection
