<!-- @-----extends('layouts.app') -->

<!-- @-----section('template_title')
    Proyecto
@----------endsection -->

<!-- @-----section('content') -->
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"> -->
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __($libro->nombre) }}
                            </span>

                            <div class="float-right" style="display:flex; gap: 10px;">
                                <a href="{{ route('proyectos.create', ['libro' => $libro->id]) }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Create New') }}
                                </a>

                                @if ($count > 1)
                                <form action="{{ route('proyectos.delete_all',$libro->id) }}" method="POST"  data-placement="left">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm float-right">
                                        {{ __('Delete all') }}
                                    </button>
                                </form>
                                @endif
                                
                            </div>
                        </div>
                    <!-- </div> -->
                    <!-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ __($message) }}</p>
                        </div>
                    @endif -->

                    <!-- <div class="card-body"> -->
                        <div class="table-responsive" style="text-align: -webkit-center; overflow-y: hidden;">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Proyecto</th>
										<th>Nombre</th>
										<th>Cantidad</th>
										<th>Precio</th>
                                        <th>Subtotal</th>
										<th>Encomendado Por</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos as $proyecto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $proyecto->categoria->nombre }}</td>
											<td>{{ $proyecto->Nombre }}</td>
											<td>{{ $proyecto->Cantidad }}</td>
											<td>$ {{ $proyecto->Precio }}</td>
                                            <td>$ {{ $proyecto->subtotal }}</td>
											<td>{{ $proyecto->Encomendado_por }}</td>

                                            <td>
                                                <form action="{{ route('proyectos.destroy',$proyecto->id) }}" method="POST">
                                                    <!-- <a class="btn btn-sm btn-primary " href="{{ route('proyectos.show',$proyecto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> -->
                                                    <a class="btn btn-sm btn-success" href="{{ route('proyectos.edit', $proyecto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($total === 0)
                                <strong>SIN DATOS AGREGADOS</strong>
                            @elseif ($total > 0)
                                <strong style="text-align: center; background-color:yellow; padding: 5px;">
                                    Total del libro: ${{ $total }}
                                </strong>
                            @endif
                        </div>
                    <!-- </div>
                </div>
                {!! $proyectos->links() !!}
            </div>
        </div>
    </div> -->
<!-- @------endsection -->

<script>
    const delete_all = async () => {
        const response = await fetch('/proyectos.delete_all')
        const data = await response.json();

        console.log(data);
    }
</script>
