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
                                <li>
                                	<h3>{{ $name }}</h3>
                                	<a href="{{route('export.index', ['institution'=>$id])}}">Для юр. лиц</a>
                                    @if(Gate::allows('modify-individual-export',$id))
                                	   | <a href="{{route('indi_export.index', ['institution'=>$id])}}">Для физ. лиц</a>
                                    @endif
                                       | <a href="{{route('institution.users', $id)}}">Сотрудники</a>
                                </li>
                            @endif
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
