@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Index') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>
                        {{ __('You are logged in!') }}
                    </h5>

                    <h1>

                        @if ( (date('H:i:s') >= '04:00:00' && date('H:i:s') < '12:00:00') )

                                {{ __('Good morning') }}

                        @elseif ( (date('H:i:s') >= '12:00:00' && date('H:i:s') < '19:00:00') )

                                {{ __('Good afternoon') }}

                        @else

                                {{ __('Good evening') }}

                        @endif

                            {{ Str::words(Auth::user()->name, 1, '') }}

                    </h1>
                    <br>
                    <h3> {{ config('app.name', 'AAR System') }} 💰</h3>
                    <p>
                        &#8594; ¡Genere y muestre PDF's sobre los registros de sus proyectos como usted desee!
                        <ul>
                            <li>Agregue al tabulador los proyectos que usted suele hacer.</li>
                            <li>Cree los libros que desee para contener todos sus proyectos.</li>
                            <li>Genere el PDF del libro que necesite, cuando lo necesite.</li>
                        </ul>
                    </p>
                    <p>
                        Aplicación web realizada con <span style="color: red; font-weight: bold; font-size:16px;">Laravel</span> + <span style="color: #bd34feff; font-weight:bold; font-size:16px;">Vite</span>
                    </p>

                    <h5>
                        Contacto: <a href="mailto:arcodev10@gmail.com">Arcodev10@gmail.com</a>
                    </h5>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
