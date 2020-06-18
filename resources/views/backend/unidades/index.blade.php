@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de unidades
                    <a href="{{ route('unidades.create') }}" class="pull-right btn btn-sm btn-primary">
                        Crear unidad
                    </a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unidades as $unidad)
                            <tr>
                                <td>{{ $unidad->id }}</td>
                                <td>{{ $unidad->title }}</td>
                                <td width="10px">
                                    <a href="{{ route('unidades.show', $unidad->id) }}" class="btn btn-sm btn-default">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('unidades.edit', $unidad->id) }}" class="btn btn-sm btn-default">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('unidades.destroy', $unidad->id) }}" method="POST">

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-sm btn-danger delete">
                                            Eliminar
                                        </button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $unidades->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
