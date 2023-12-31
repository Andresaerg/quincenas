@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Proyecto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Proyecto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('proyectos.update', ['proyecto' => $proyecto->id, 'libro' => $libro]) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('proyecto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
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
</script>
