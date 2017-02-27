@extends('layouts.app')

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
    <div class="panel panel-default">
        <div class="panel-heading">Справочники</div>
        <div class="panel-body">
            <ul>
               <li><a href="{{ route('user'.index') }}">Учреждения</a></li>
               <li><a href="{{ route('organization'.index') }}">Учреждения</a></li>
               <li><a href="{{ route('region'.index') }}">Учреждения</a></li>
               <li><a href="{{ route('transport'.index') }}">Учреждения</a></li>
               <li><a href="{{ route('purpose'.index') }}">Учреждения</a></li>
               <li><a href="{{ route('product_type.index') }}">Учреждения</a></li>
               <li><a href="{{ route('storage.index') }}">Учреждения</a></li>
               <li><a href="{{ route('institution.index') }}">Учреждения</a></li>
            </ul>
        </div>
    </div>
@endsection
