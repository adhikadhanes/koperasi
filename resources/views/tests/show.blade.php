@extends('layouts.app')

@section('content')
    @include('tests.show_fields')

    <div class="form-group">
           <a href="{!! route('tests.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
