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
                        <span class="glyphicon glyphicon-user"></span>
                    </h1>
                    <hr>
                 </center>
            
                </div>
            </div>
            <div class="col-md-6 box">
            <center>
            <h2>
             <span class="glyphicon glyphicon-piggy-bank"></span>
                Anda memiliki {{ Auth::user()->poin }} poin
            </h2>
            <center>
            </div>



        </div>

        <div class="col-md-6">


            <div class="col-md-6 box">
                 <div class="col-md-12">
                    <center>
                    <h2>Top Spenders</h2>
                    <hr>
                        <table class="table table-responsive" id="users-table">
                            <thead>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Poin</th>
                            </thead>
                            <tbody>


                             {{-- */$x=0;/* --}}
                
                            @foreach($users as $user)
                                {{-- */$x++;/* --}}
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>{!! $user->name !!}</td>
                                    <td>{!! $user->poin !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </center>
                    </div>
                    </div>
        </div>

            <div class="clearfix"></div>
@endsection
