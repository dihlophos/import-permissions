@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <h1>Справочники</h1>
    <ul>
       <li><a href="{{ URL::action('OrganizationController@index') }}">Организации</a></li>
       <li><a href="{{ URL::action('RegionController@index') }}">Регионы/районы</a></li>
       <li><a href="{{ URL::action('TransportController@index') }}">Транспорт</a></li>
       <li><a href="{{ URL::action('PurposeController@index') }}">Цель вывоза</a></li>
       <li><a href="{{ URL::action('ProductTypeController@index') }}">Виды грузов<a></li>
       <li><a href="{{ URL::action('StorageController@index') }}">Базы хранения</a></li>
    </ul>
@endsection
