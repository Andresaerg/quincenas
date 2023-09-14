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
                            <input type="number" id="num-proyectos" value="1" min="1" oninput="updateForm()">
                        </div>
                        <div id="formularios">
                            <form method="POST" id="form_" action="{{ route('proyectos.store', ['libro' => $libro]) }}"  role="form" enctype="multipart/form-data">
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
        const template = document.querySelector('#form-template').innerHTML;

        console.log(numProyectos)
        formularios.innerHTML = '';

        var btn = document.createElement('button')

        for (var i = 0; i < numProyectos; i++) {
            console.log(i)
            var form = document.createElement('form');
            form.id = 'form_'+i;
            form.method = 'POST';
            form.action = '{{ route("proyectos.store", ["libro" => $libro]) }}';
            form.role = 'form';
            form.enctype = 'multipart/form-data';

            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}'; // Asegúrate de que estás en un entorno Blade para poder usar esta directiva
            form.appendChild(csrfInput);

            /* form.innerHTML += template.replace(/__index__/g, i); */

            var modifiedTemplate = template.replace(/id="price-labelh"/g, 'id="price-labelh_' + i + '"');
            modifiedTemplate = modifiedTemplate.replace(/id="price-label"/g, 'id="price-label_' + i + '"');
            modifiedTemplate = modifiedTemplate.replace(/id="project_"/g, 'id="project_' + i + '"');

            form.innerHTML += modifiedTemplate;

            form.querySelector(`select#project_${i}`).onchange = createCallback(i);

            form.querySelector('button').hidden = true;

            formularios.appendChild(form);

            btn.onclick = submitAll/* function() {
                for (var i = 0; i < numProyectos; i++) {
                    document.getElementById('form_' + i).submit();
                }
            } */
        }

        btn.innerText = 'Cargar formularios'
        btn.classList.add('btn')
        btn.classList.add('btn-primary')

        formularios.appendChild(btn)
    }

    const updatePrice = async (value, index) => {
        console.log(value)
        console.log(index)

        const response = await fetch(`/price/${value}`)
        const data = await response.json()
        const price = data.precio
        
        if(index !== undefined ){
            document.getElementById('price-label_' + index).value = price
            document.getElementById('price-labelh_' + index).innerText = price
        }else{
            document.getElementById('price-label').value = price
            document.getElementById('price-labelh').innerText = price
        }
        
    }

    function gatherFormData() {
        const numProyectos = document.querySelector('#num-proyectos').value;
        const data = [];

        for (var i = 0; i < numProyectos; i++) {
            const form = document.getElementById('form_' + i);
            const formData = new FormData(form);
            data.push(Object.fromEntries(formData));
        }

        return data;
    }

    async function submitAll() {
        let flag = false;

        document.querySelectorAll('input, select').forEach(e => {
            if(e.value === ''){
                e.classList.add('is-invalid')
                flag = true
            }else{
                e.classList.remove('is-invalid')
            }
        })
        
        if(flag === false){
            const data = gatherFormData();
            const libro = '<?php echo $libro?>';
    
            const response = await fetch('{{ route("proyectos.store", ["libro" => $libro]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ proyectos: data })
            });
    
            if (!response.ok) {
                console.error('Error:', response.statusText);
            } else {
                window.location.href = `/libros/${libro}`;
                /* const result = await response.text();
                console.log('Success:', result); */
            }
        }
    }

    function createCallback(index) {
        return function() {
            updatePrice(this.value, index);
        };
    }

</script>
