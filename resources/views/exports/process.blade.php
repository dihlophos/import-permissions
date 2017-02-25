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
    <div class="col-md-5">
        <dl class="dl-horizontal">
            <dt>Разрешение</dt>
            <dd>
                от <u>{{empty($export->permission_date)?str_repeat('&nbsp;',20):$export->permission_date}}</u>
                № <u>{{empty($export->permission_num)?str_repeat('&nbsp;', 6):$export->permission_num}}</u>
            </dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Цель вывоза</dt>
            <dd>{{$export->purpose->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Районы, города ТО</dt>
            <dd>{{$export->district->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>База хранения</dt>
            <dd>{{$export->storage->name}}</dd>
        </dl>
    </div>
    <div class="col-md-7">
        <dl class="dl-horizontal">
            <dt>Организация</dt>
            <dd>{{$export->organization->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Вывоз в регион</dt>
            <dd>{{$export->region->name}}</dd>
        </dl>
        <dl class="dl-horizontal">
            <dt>Вывоз в район</dt>
            <dd>{{$export->dest_district->name}}</dd>
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
        <table class="table table-condensed table-hover">
            <thead>
                <th></th>
                <th>Груз</th>
                <th>Ед изм</th>
                <th>Количество</th>
                <th>Производитель</th>
            </thead>
            <tbody>
            @foreach ($exported_products as $product)
                <tr class="text-primary clickable" data-toggle="collapse" data-target=".processed_{{$product->id}}" role="button" aria-expanded="true">
                    <td>
                        <i class="fa fa-caret-square-o-up" aria-hidden="true"></i>
                    </td>
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
                </tr>
                <tr class="processed_{{$product->id}} collapse in">
                    <td colspan="5">
                        <form action="{{route('processed_product.store')}}" class="form-inline"
                              id="ProcessedProductAddForm{{$product->id}}" method="post" accept-charset="utf-8" class="form-horizontal">
                            {{ csrf_field() }}
                            <input name="exported_product_id" type="hidden" value="{{$product->id}}">
                            <div class="form-group">
                                <label class="sr-only" for="processed_date">Груз</label>
                                <input name="date" id="processed_date" type="date" class="form-control" placeholder="дата">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="processed_measure">Ед изм</label>
                                <select name="measure" id="processed_measure" class="form-control" placeholder="ед изм">
                                    <option value="тонна">тонна</option>
                                    <option value="тыс.шт.">тыс.шт.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="processed_count">Количество</label>
                                <input name="count" class="form-control" id="processed_count" type="number" placeholder="количество">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Добавить
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @foreach ($product->processed_products as $processed)
                <tr class="processed_{{$product->id}} collapse in">
                    <td colspan="5">
                        <div style="float: left;">
                            <form action="{{route('processed_product.update', $processed->id)}}" class="form-inline"
                                  id="ProcessedProductAddForm{{$product->id}}" method="post" accept-charset="utf-8" class="form-horizontal">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input name="exported_product_id" type="hidden" value="{{$processed->exported_product_id}}">
                                <div class="form-group">
                                    <label class="sr-only" for="processed_date">Груз</label>
                                    <input name="date" value="{{$processed->date}}" id="processed_date" type="date" class="form-control" placeholder="дата">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="processed_measure">Ед изм</label>
                                    <select name="measure" id="processed_measure" class="form-control" placeholder="ед изм">
                                        <option value="тонна" {{$processed->measure=='тонна'?'selected':''}}>тонна</option>
                                        <option value="тыс.шт." {{$processed->measure=='тыс.шт.'?'selected':''}}>тыс.шт.</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="processed_count">Количество</label>
                                    <input name="count" value="{{$processed->count}}" class="form-control" id="processed_count" type="number" placeholder="количество">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div style="float: left; padding-left: 5px;">
                            <form action="{{route('processed_product.destroy', $processed->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-primary">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        {{$exported_products->links()}}
  </div>
</div>
@endif
@endsection

@section('scripts')
<script type="text/javascript">
$(function () {
    $(document).on('click', 'tr.clickable', function(e){
        var $this = $(this);
    	if(!$this.hasClass('collapsed')) {
            $this.addClass('collapsed');
    		$this.find('i').removeClass('fa-caret-square-o-up').addClass('fa-caret-square-o-down');
    	} else {
            $this.removeClass('collapsed');
    		$this.find('i').removeClass('fa-caret-square-o-down').addClass('fa-caret-square-o-up');
    	}
    })
});
</script>
@endsection
