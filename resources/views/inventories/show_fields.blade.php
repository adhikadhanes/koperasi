<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('Nama', 'Nama:') !!}
    <p>{!! $inventory->Nama !!}</p>
</div>

<!-- Harga Field -->
<div class="form-group">
    {!! Form::label('Harga', 'Harga:') !!}
    <p>{!! $inventory->Harga !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('file', 'Image:') !!}
    <p>{!! $inventory->file !!}</p>
</div>


<!-- Jumlah Field -->
<div class="form-group">
    {!! Form::label('Jumlah', 'Jumlah:') !!}
    <p>{!! $inventory->Jumlah !!}</p>
</div>

