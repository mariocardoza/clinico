@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Unidad</div>

                <div class="panel-body">

                    <form action="{{ route('unidades.store') }}" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Name *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Guardar" class="btn btn-sm btn-primary">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
