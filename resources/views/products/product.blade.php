@extends('layouts.app')

@section('content')
<section class="content-header">
        <h1 class="pull-left">Product</h1>
        <br>
    </section>

<div class="container-folio row">
	<div class="col-md-12">


				<!-- PROD GRID 
				============================================================ -->
				
				<!-- PROD. ITEM -->
				 <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
					<div class="thumbnail">
						<!-- IMAGE CONTAINER-->
						<img src="images/thumb.jpg" alt="post image">
						<!--END IMAGE CONTAINER-->
						<!-- CAPTION -->
						<div class="caption">
						<h3 class="">Product title</h3>
							<p class="">This project presents beautiful style graphic &amp; design. Bootstraptor provides modern features</p>
							
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<p class="lead">$21.000</p>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<a class="btn btn-success btn-block" href="#">Add to cart</a>
								</div>
							</div>
						</div> 
						<!--END CAPTION -->
					</div>
					<!-- END: THUMBNAIL -->
				</div>
				<!-- PROD. ITEM -->
				
			
				
				<!-- / PROD GRID 
				======================================= -->
	</div>
</div>


@endsection