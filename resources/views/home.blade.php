@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Учреждения ветеринарной службы региона</div>

                <div class="panel-body">
                    @foreach($institutions as $institution)
                        <ul>
                            @if(Gate::allows('view-export',$institution->id))
                                <li>
                                	<h3>{{ $institution->name }}</h3>
                                	<a href="{{route('export.index', ['institution'=>$institution->id])}}">Для юр. лиц</a>
                                    @if(Gate::allows('modify-individual-export',$institution->id))
                                	   | <a href="{{route('indi_export.index', ['institution'=>$institution->id])}}">Для физ. лиц</a>
                                    @endif
                                    @can('attachUsersToStorages', $institution)
                                       | <a href="{{route('institution.users', $institution->id)}}">Сотрудники</a>
                                    @endcan
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
