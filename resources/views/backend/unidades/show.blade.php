@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Unidad
                    <a href="{{ url()->previous() }}" class="pull-right btn btn-sm btn-primary">Atrás</a>
                </div>
                <div class="panel-body">
                    <p><strong>Nombre</strong> {{ $unidad->nombre}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
