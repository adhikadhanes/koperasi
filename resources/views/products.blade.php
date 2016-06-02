@extends('layouts.app')

@section('content')
<div class="container">
    <h4><i class="fa fa-shopping-cart"></i> cart</h4>
    <hr>
    <!-- Panel -->
    <div class="col-md-10">
    <div class="panel">
        <div class="panel-heading"><h2>Cart</h2></div>
        
        <table class="table table-striped m-b-none text-sm">
          <thead>
            <tr>
              <th width="8">No</th>
              <th width="200">Product Name</th>                    
              <th>Price</th>
              <th width="100">Quantity</th>
              <th width="200">Action</th>
            </tr>
          </thead>
          <tbody>

          <?php $i = 1; ?>
          @foreach($cart_content as $cart)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $cart->name }}</td>
                <td>{{ $cart->price }}</td>
                <td>{{ $cart->qty }}</td>
                <td>
                    <a href="{{ url('cart/delete/'.$cart->rowid) }}">delete</a>
                </td>
            </tr>
          <?php $i++; ?>
          @endforeach

          </tbody>
      </table>

      <div class="panel-footer">
        <a href="{{ url('product') }}" class="btn btn-white">Continue Shopping</a>
  
        {!! Form::open(['url' => 'cart/checkout', 'class' => 'form-inline']) !!}
        <div class="col-md-3">
        {!! Form::label('Pembeli', 'Pembeli: ', ['class' => 'control-label']) !!}
        {!! Form::select('Pembeli', $users , null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Checkout', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}

<!--         <a href="{{ url('cart/checkout') }}" class="btn btn-info">Checkout</a> -->
      </div>
    </div>
    </div>
    <!-- / Panel -->
</div>
@endsection