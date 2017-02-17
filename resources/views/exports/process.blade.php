@extends('layouts.app')

@section('styles')
<link href="{{ asset('/css/selectize.css') }}" rel="stylesheet">
<link href="{{ asset('/css/selectize.bootstrap3.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    @include('common.flash')
<div class="row">
    <div class="col-md-4">
        <dl class="dl-horizontal">
            <dt>№ разрешения</dt>
            <dd>{{$export->permission_num}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Дата разрешения</dt>
            <dd>{{$export->permission_date}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Цель вывоза</dt>
            <dd>{{$export->purpose->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Районы, города ТО</dt>
            <dd>{{$export->district->name}}</dd>
        </dl>
    </div>
    <div class="col-md-8">
        <dl class="dl-horizontal">
            <dt>База хранения</dt>
            <dd>{{$export->storage->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Организация</dt>
            <dd>{{$export->organization->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Вывоз в регион</dt>
            <dd>{{$export->region->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Адрес в регионе</dt>
            <dd>{{$export->address}}</dd>
        </dl>
    </div>
</div>

@if (count($exported_products) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Вывоз продукции
    </div>

    <div class="panel-body">
        {{$exported_products->links()}}
        <table class="table table-striped task-table">
            <thead>
                <th>Груз</th>
                <th>Ед изм</th>
                <th>Количество</th>
                <th>Производитель</th>
                <th>Удалить</th>
            </thead>
            <tbody>
            @foreach ($exported_products as $product)
                <tr>
                    <td class="table-text">
                        {{$product->product_type->name}}
                    </td>
                    <td class="table-text">
                        {{$product->measure}}
                    </td>
                    <td class="table-text">
                        {{$product->count}}
                    </td>
                    <td class="table-text">
                        {{$product->manufacturer}}
                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$exported_products->links()}}
  </div>
</div>
@endif

@endsection
