<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Nama', 'Nama:') !!}
    {!! Form::text('Nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Jumlah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Jumlah', 'Jumlah:') !!}
    {!! Form::number('Jumlah', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Harga', 'Harga:') !!}
    {!! Form::number('Harga', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
	{!! Form::label('file', 'File: ', ['class' => 'col-sm-12 control-label']) !!} 
	 <div class="col-sm-8">
    {!! Form::file('file') !!}
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('inventories.index') !!}" class="btn btn-default">Cancel</a>
</div>
