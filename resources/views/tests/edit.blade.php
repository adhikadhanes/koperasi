@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit test</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($test, ['route' => ['tests.update', $test->id], 'method' => 'patch']) !!}

            @include('tests.fields')

            {!! Form::close() !!}
        </div>
@endsection