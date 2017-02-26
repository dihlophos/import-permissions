@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Учреждения ветеринарной службы региона</div>

                <div class="panel-body">
                    @foreach($institutions as $id=>$name)
                        <ul>
                            @if(Gate::allows('view-export',$id))
                                <li><a href="{{route('export.index', ['institution'=>$id])}}">{{ $name }}</a></li>
                            @endif
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
