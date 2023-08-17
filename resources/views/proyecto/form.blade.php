<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Seleccione Libro') }}
            {{ Form::select('Seleccione Libro', ['' => 'Seleccione Libro'] + $libros->toArray(), $proyecto->libros_id, ['class' => 'form-control' . ($errors->has('libros_id') ? ' is-invalid' : '')], ['' => ['disabled']]) }}
            {!! $errors->first('libros_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Proyecto') }}
            {{ Form::select('Seleccione proyecto', ['' => 'Seleccione Proyecto'] + $categorias->toArray(), $proyecto->categorias_id, ['class' => 'form-control' . ($errors->has('categorias_id') ? ' is-invalid' : '')], ['' => ['disabled']]) }}
            {!! $errors->first('categorias_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $proyecto->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::text('Cantidad', $proyecto->Cantidad, ['class' => 'form-control' . ($errors->has('Cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) }}
            {!! $errors->first('Cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Precio') }}
            {{ Form::text('Precio', $proyecto->Precio, ['class' => 'form-control' . ($errors->has('Precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio', 'onkeypress' => 'return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 46 && this.value.length > 0 && this.value.indexOf(".") == -1)']) }}
            {!! $errors->first('Precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Encomendado_por') }}
            {{ Form::text('Encomendado_por', $proyecto->Encomendado_por, ['class' => 'form-control' . ($errors->has('Encomendado_por') ? ' is-invalid' : ''), 'placeholder' => 'Encomendado Por']) }}
            {!! $errors->first('Encomendado_por', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>