@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar unidad</div>

                <div class="panel-body">

                    <form action="{{ route('unidades.update', $unidad->id) }}" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="title">Nombre</label>
                            <input type="text" name="title" class="form-control" value="{{ old('nombre', $lesson->nombre) }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-sm btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
