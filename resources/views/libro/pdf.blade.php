<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    
    <!-- <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css"> -->
    <style>
        *{
            font-family: system-ui, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }
        .table-responsive {
            text-align: -webkit-center;
            overflow-y: hidden;
        }
        .table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            font-size: 15px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
        }
        .Logo{
            font-family: 'Courier New', monospace; 
            font-style: italic;
            margin-bottom: 0;
        }
        .container {
            width: 100%;
        }
        .container td {
            text-align: center;
            width: 33.33%;
        }
        .container td p{
            margin:0;
        }

        @page{
            margin: 0px;
        }
    </style>
</head>
<body>
    {{-- <table class="container">
        <tr>
            <td>
                <img src="{{ public_path('images/test.jpg') }}" alt="test" style="width:100px; border-radius:50%;">
            </td>
            <td>
                <h2 class="Logo">Sistema AAR para quincenas</h2>
                <h6 style="margin-top:0; font-family:'Courier New', monospace; font-style:italic;">by AR</h6>
            </td>
            <td>
                <p>Libro: {{ $libro->nombre }}</p>
                <p>Nombre de usuario: {{ $user->name }}</p>
                <p>Fecha de creación del libro: {{ $libro->created_at->format('d/m/Y') }}</p>
                <p>Fecha actual: {{ date('d/m/Y') }}</p>
            </td>
        </tr>
    </table> --}}

    <div style="padding: 2rem; background: #efefef;">
        <div style="float: left; width: 15%; height: 10%;">
            <img src="{{ public_path('images/test.jpg') }}" alt="test" style="width:100px; border-radius:50%;">
        </div>
        <div style="float: left; width: 35%; height: 10%;">
            <h2 class="Logo">Sistema AAR para quincenas</h2>
            <h6 style="margin-top:0; font-family:'Courier New', monospace; font-style:italic;">by AR</h6>
        </div>
        <div style="margin-left: 35%; width: 65%; height: 10%; text-align:right;">
            Fecha actual: {{ date('d/m/Y') }}
            <br>
            Libro: {{ $libro->nombre }}
        </div>
    </div>

    <div style="margin: 1rem 2rem 0 2rem;">
        <div style="border: 2px solid #4CAF50; margin-bottom: 1rem;"></div>

        <div style="margin-bottom: 10rem;">
            <div style="float: left; width: 55%; height: auto;">
                <strong style="font-size:18px;">Empleado</strong>
                <br>
                {{ $user->name }}
                <br><br>
                <strong style="font-size:18px;">Libro actual</strong>
                <strong style="font-size:18px;margin-left:80px;">Fecha de creación</strong>
                <br>
                {{ $libro->nombre }}
                <span style="font-size:18px;margin-left:65px;">{{ $libro->created_at->format('d/m/Y') }}</span>
            </div>
            <div style="float: left; width: 5%; height: auto;">

            </div>
            <div style="float: left; width: 40%; height: auto; text-align:right;">
                <strong style="text-align: right; padding: 5px;">Total de proyectos: </strong>
                {{ $total_projects }}
            </div>
        </div>

        <div style="border: 2px solid #4CAF50; margin-bottom: 2rem;"></div>
    
        <div class="table-responsive">
            <div>
                <strong>Tabla de proyectos realizados</strong>
            </div>
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Proyecto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Encomendado Por</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 0)
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $proyecto->categoria->nombre }}</td>
                            <td>{{ $proyecto->Nombre }}</td>
                            <td>{{ $proyecto->Cantidad }}</td>
                            <td>${{ $proyecto->Precio }}</td>
                            <td>${{ $proyecto->subtotal }}</td>
                            <td>{{ $proyecto->Encomendado_por }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <br>
            <!-- Aquí puedes agregar el total -->
            <table align='right'>
                <{{-- tr>
                    <td>
                        <strong style="text-align: right; padding: 5px;">
                            Total de proyectos: {{ $total_projects }}
                        </strong>
                    </td>
                </tr> --}}
                <tr>
                    <td>
                        <strong style="text-align: center; background-color:yellow; padding: 5px; font-size: 25px;">
                            Total: $ {{ $total_price }}
                        </strong>
                    </td>
                </tr>
            </table>
    
        </div>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Página {PAGE_NUM}/{PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>
