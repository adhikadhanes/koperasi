@extends('layouts.app')

@section('content')
<br>
<div class="col-md-6">
            <div class="col-md-6 box">
                 <div class="col-md-12">
                    <center>
                    

            <br>
            <h1>
                Selamat Datang, <br> {{ Auth::user()->name }}
            </h1>
            <hr>
        

        </center>
            <!-- You can dynamically generate breadcrumbs here -->
   <!--          <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol> -->
        </div>
        </div>
        </div>
@endsection
