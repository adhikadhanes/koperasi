@extends('layouts.app')

@section('content')
@include('flash::message')
<section class="content-header">
        <h1 class="pull-left">Product</h1>
        <br>
    </section>

<div class="container-folio row">
	<div class="col-md-12">
            
				<!-- PROD GRID 
				============================================================ -->
				
				@foreach($inventories as $inventory)
				<!-- PROD. ITEM -->
				 <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<div class="thumbnail">
						<!-- IMAGE CONTAINER-->
						<img src="{{ url('uploads', $inventory->file )}}" alt="post image" width="200px">
						<!--END IMAGE CONTAINER-->
						<!-- CAPTION -->
						<div class="caption">
						<h2 class="">{!! $inventory->Nama !!}</h2>
						<p>stok : {!! $inventory->Jumlah !!}</p>	
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<p class="lead">Rp{!! $inventory->Harga !!}</p>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-info pull-right" href="{{ url('product/cart/'.$inventory->id) }}"><i class="fa fa-shopping-cart"></i> add to cart</a>
								</div>
							</div>
						</div> 
						<!--END CAPTION -->
					</div>
					<!-- END: THUMBNAIL -->
				</div>
				<!-- PROD. ITEM -->
				@endforeach
				
			
				
				<!-- / PROD GRID 
				======================================= -->
	</div>
</div>


@endsection