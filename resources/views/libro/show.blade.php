@extends('layouts.app')

@section('template_title')
    {{ $libro->name ?? "{{ __('Show') Libro" }} }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Showing') }} Libro {{ $libro->id }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-right">
                                <a class="btn btn-secondary" href="{{ route('libros.index') }}"> {{ __('Back') }}</a>
                            </div>
                            @if ($total > 0)
                            <div class="float-right">
                                <a class="btn btn-success" href="{{ route('libros.pdf', $libro->id) }}"><i class="fa fa-fw fa-file-pdf"></i> {{ __('Generar PDF para este libro') }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ __($message) }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre del libro:</strong>
                            {{ $libro->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad de proyectos:</strong>
                            {{ $count }}
                            <div>
                                <div style="display: flex; justify-content: center; text-transform: uppercase;">
                                    <strong>Tabla de proyectos</strong>
                                </div>
                                <br>
                                <div>
                                    @include('proyecto.index')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
