@extends('layouts.master')
@section('cabecera')

<div class="container-fluid">
<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Inicio</h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item active">Panel de control</li>
    </ol>
  </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@section('content')
<inicio-component></inicio-component>
@endsection
