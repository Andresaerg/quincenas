<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Seleccione Libro') }}
            {{ Form::select('libros_id', $libros, $proyecto->libros_id, ['class' => 'form-control' . ($errors->has('libros_id') ? ' is-invalid' : ''), 'disabled'], [$libro => ['selected']]) }}
            {{ Form::hidden('libros_id', $libro) }}
            {!! $errors->first('libros_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Proyecto') }}
            {{ Form::select('categorias_id', ['' => 'Seleccione Proyecto'] + $categorias->toArray(), $proyecto->categorias_id, ['id' => 'project_','class' => 'form-control' . ($errors->has('categorias_id') ? ' is-invalid' : ''), 'onchange' => 'updatePrice(this.value, undefined)'],['' => ['disabled']]) }}
            {!! $errors->first('categorias_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $proyecto->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Cantidad') }}
            {{ Form::text('Cantidad', $proyecto->Cantidad, ['class' => 'form-control' . ($errors->has('Cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) }}
            {!! $errors->first('Cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Precio') }}
            {{ Form::label('Precio', $proyecto->Precio, ['id' => 'price-labelh', 'class' => 'form-control' . ($errors->has('Precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {{ Form::hidden('Precio', $proyecto->Precio, ['id' => 'price-label', 'class' => 'form-control' . ($errors->has('Precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('Precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            {{ Form::label('Encomendado_por') }}
            {{ Form::text('Encomendado_por', $proyecto->Encomendado_por, ['class' => 'form-control' . ($errors->has('Encomendado_por') ? ' is-invalid' : ''), 'placeholder' => 'Encomendado Por']) }}
            {!! $errors->first('Encomendado_por', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" id="submit_btn" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>