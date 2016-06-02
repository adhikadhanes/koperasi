<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Nama', 'Nama:') !!}
    {!! Form::select('Nama', $barang, null, ['class' => 'form-control' , 'required'=> 'required'] ) !!}
</div>

<!-- Jumlah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Jumlah', 'Jumlah:') !!}
    {!! Form::number('Jumlah', null, ['class' => 'form-control']) !!}
</div>

<!-- Pembeli Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Pembeli', 'Pembeli:') !!}
    {!! Form::select('Pembeli', $user, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('penjualans.index') !!}" class="btn btn-default">Cancel</a>
</div>
