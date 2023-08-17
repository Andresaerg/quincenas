@extends('layouts.app')

@section('template_title')
    {{ $proyecto->name ?? "{{ __('Show') Proyecto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Proyecto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('proyectos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Libros Id:</strong>
                            {{ $proyecto->libros_id }}
                        </div>
                        <div class="form-group">
                            <strong>Categorias Id:</strong>
                            {{ $proyecto->categorias_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $proyecto->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $proyecto->Cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $proyecto->Precio }}
                        </div>
                        <div class="form-group">
                            <strong>Encomendado Por:</strong>
                            {{ $proyecto->Encomendado_por }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
