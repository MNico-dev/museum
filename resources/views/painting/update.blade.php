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

@if(count($errors)>0)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <ul>
                {{$errors}}
            </ul>
        </div>
    </div>
</div>
@endif

<h3>Editar cuadro {{$painting->id}}</h3>

<div class="row">
    <div class="col-md-9">
        <form action="{{route('cuadros.update',$painting->id)}}" class="offset-4" method="post">
            @csrf
            @method('PUT')
            <label for="nombre" class="">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="name" value="{{$painting->name}}" required>
            <label for="pintor">Pintor/a</label>
            <input type="text" id="pintor" class="form-control" name="painter" value="{{$painting->painter}}" required>
            <br>
            <button type="submit" class="btn btn-info">Editar cuadro</button>
        </form>
    </div>
</div>
@endsection
