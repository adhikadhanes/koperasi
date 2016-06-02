<?php
use App\Models\Inventory;
use App\Models\Penjualan;
use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');



Route::resource('inventories', 'InventoryController');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/home', 'HomeController@index');

Route::resource('penjualans', 'PenjualanController');

Route::resource('users', 'UserController');

Route::get('invoice', 'InventoryController@invoice');
Route::get('product', 'InventoryController@product');

Route::get('product/cart/{id}', function($id){
		$users = User::paginate()->lists('name','id');
		$inventory = Inventory::find($id);

		$id          = $inventory->id;
		$name        = $inventory->Nama;
		$qty         = 1;
		$price       = $inventory->Harga;

		$data = array('id'          => $id, 
					  'name'        => $name, 
					  'qty'         => $qty, 
					  'price'       => $price, 
					  'options'     => array('size' => 'large'));

		Cart::add($data);

		$cart_content = Cart::content(1);
		return View::make('products')->with('cart_content', $cart_content)->with('users',$users);
});

Route::get('mycart',function() {
	$users = User::paginate()->lists('name','id');
	$cart_content = Cart::content(1);
		return View::make('products')->with('cart_content', $cart_content)->with('users',$users);
});

Route::get('cart/delete/{id}' , function($id){
	Cart::remove($id);
	$cart_content = Cart::content(1);
	return View::make('products')->with('cart_content', $cart_content);
});

Route::post('cart/checkout', 'PenjualanController@checkout');


