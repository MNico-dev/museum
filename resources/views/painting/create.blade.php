@extends('layouts.app')
@section('title', 'Lista de cuadros')
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('cuadros.index')}}" class="btn btn-dark" role="button"><i class="fa fa-reply"></i>
            Volver a la lista de cuadros
        </a>
    </div>
</div>
<h1>Crear cuadro</h1>

<div class="row">
    <div class="col-md-9">
        <form action="{{route('cuadros.store')}}" class="offset-4" method="POST">
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="name" required>
            <label for="pintor">Pintor/a</label>
            <input type="text" id="pintor"  class="form-control" name="painter" required>
            <br>
            <button type="submit" class="btn btn-success">Crear cuadro</button>
        </form>
    </div>
</div>
@endsection
