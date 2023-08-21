@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Proyecto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Proyecto</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ url()->previous() }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="display: flex; flex-direction: row; gap: 10px; justify-content: right;">
                            <label for="num-proyectos">Número de proyectos:</label>
                            <input type="number" id="num-proyectos" value="1" min="1" onchange="updateForm()">
                        </div>
                        <div id="formularios">
                            <form method="POST" action="{{ route('proyectos.store', ['libro' => $libro]) }}"  role="form" enctype="multipart/form-data">
                                @csrf
    
                                @include('proyecto.form', ['index' => 0])
    
                            </form>
                        </div>
                        <template id="form-template">
                            @include('proyecto.form', ['index' => '__index__'])
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    function updateForm() {
        const numProyectos = document.querySelector('#num-proyectos').value;
        const formularios = document.querySelector('#formularios');
        const formTemplate = document.querySelector('#form-template');

        // Eliminar formularios existentes
        formularios.innerHTML = '';

        // Agregar nuevos formularios
        for (let i = 0; i < numProyectos; i++) {
            const form = formTemplate.cloneNode(true);
            console.log(form.innerHTML)
            form.innerHTML = form.innerHTML.replace(/__index__/g, i);
            formularios.appendChild(form);
        }
    }

    const updatePrice = async (value) => {
        console.log(value)

        const response = await fetch(`/price/${value}`)
        const data = await response.json()
        const price = data.precio
        
        document.getElementById('price-label').value = price
        document.getElementById('price-labelh').innerText = price
    }
</script>
