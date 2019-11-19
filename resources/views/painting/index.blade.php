@extends('layouts.app')
@section('title', 'Lista de cuadros')
@section('content')
<h3>Administracion de Cuadros</h3>


<div class="row">
    <div class="col-md-12">
        <a href="{{route('api.logout')}}"><i class="fa fa-close"></i>Cerrar sesion modulo cuadros</a>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <a class="btn btn-success float-right" href="{{route('cuadros.create')}}"><i class="fa fa-plus"></i>Crear cuadro</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="painting-table table table-bordered table-striped table-hover data display text-center" >
                <thead class="text-center">
                <tr>
                    <th class="unorderable"><i class="fa fa-cogs"></i></th>
                    <th class="orderable exportable ">#ID</th>
                    <th class="orderable exportable">Nombre</th>
                    <th class="orderable exportable">Pintor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paintings->data as $p)
                <tr>
                    <td>
                        <div class="btn btn-group">
                            <a type="button" href="{{route('cuadros.edit',['painting' => $p->id])}}"
                               class="btn btn-info"><i class="fa fa-edit"></i>Editar
                            </a>
                            <form  action="{{route('cuadros.destroy',$p->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" data-toggle="confirmation" data-title="&iquest; Confirma la operaci&oacute;n
                                            ?" data-btn-ok-label="Confirmar" data-singleton="true" class="btn btn-danger">
                                    <i class="fa fa-close"></i>Borrar
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{$p->id}}</td>
                    <td>{{$p->name}}</td>
                    <td>{{$p->painter}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script  type="text/javascript" language="javascript">
    window.nombreXls ="cuadros";
</script>
@endsection
