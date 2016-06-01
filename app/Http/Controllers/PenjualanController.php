<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Repositories\PenjualanRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Inventory;
use App\Models\Penjualan;
use App\User;
use Cart;
use App\Http\Requests\CreateInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Repositories\InventoryRepository;


class PenjualanController extends AppBaseController
{
    /** @var  PenjualanRepository */
    private $penjualanRepository;

    public function __construct(PenjualanRepository $penjualanRepo)
    {
        $this->penjualanRepository = $penjualanRepo;
    }

    /**
     * Display a listing of the Penjualan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->penjualanRepository->pushCriteria(new RequestCriteria($request));
        $penjualans = $this->penjualanRepository->all();

        return view('penjualans.index')
            ->with('penjualans', $penjualans);
    }

    /**
     * Show the form for creating a new Penjualan.
     *
     * @return Response
     */
    public function create()
    {
        $barang = \DB::table('inventories')->lists('Nama', 'id');
        $user = \DB::table('users')->lists('name','id');
        
        return view('penjualans.create', compact('barang','user'));
    }

    /**
     * Store a newly created Penjualan in storage.
     *
     * @param CreatePenjualanRequest $request
     *
     * @return Response
     */
    public function store(CreatePenjualanRequest $request)
    {
        $input = $request->all();

        $penjualan = $this->penjualanRepository->create($input);

        Flash::success('Penjualan saved successfully.');

        //update stok disini

        return redirect(route('penjualans.index'));
    }

    /**
     * Display the specified Penjualan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penjualan = $this->penjualanRepository->findWithoutFail($id);

        if (empty($penjualan)) {
            Flash::error('Penjualan not found');

            return redirect(route('penjualans.index'));
        }

        return view('penjualans.show')->with('penjualan', $penjualan);
    }

    /**
     * Show the form for editing the specified Penjualan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penjualan = $this->penjualanRepository->findWithoutFail($id);

        if (empty($penjualan)) {
            Flash::error('Penjualan not found');

            return redirect(route('penjualans.index'));
        }

        return view('penjualans.edit')->with('penjualan', $penjualan);
    }

    /**
     * Update the specified Penjualan in storage.
     *
     * @param  int              $id
     * @param UpdatePenjualanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePenjualanRequest $request)
    {
        $penjualan = $this->penjualanRepository->findWithoutFail($id);

        if (empty($penjualan)) {
            Flash::error('Penjualan not found');

            return redirect(route('penjualans.index'));
        }

        $penjualan = $this->penjualanRepository->update($request->all(), $id);

        Flash::success('Penjualan updated successfully.');

        return redirect(route('penjualans.index'));
    }

    /**
     * Remove the specified Penjualan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $penjualan = $this->penjualanRepository->findWithoutFail($id);

        if (empty($penjualan)) {
            Flash::error('Penjualan not found');

            return redirect(route('penjualans.index'));
        }

        $this->penjualanRepository->delete($id);

        Flash::success('Penjualan deleted successfully.');

        return redirect(route('penjualans.index'));
    }

   public function checkout(Request $request){
            
        $formid       = str_random();
        $cart_content = Cart::content(1);
        $user = User::find($request->Pembeli);

        foreach ($cart_content as $cart) {

            $penjualans  = new Penjualan();

            $product = Inventory::find($cart->id);

            // $penjualan->id  = $cart->id;
            $penjualans->Nama     = $product->Nama;
            $penjualans->Jumlah         = $cart->qty;
            $penjualans->Harga_Total = $cart->price * $cart->qty;
            $penjualans->Pembeli      = $request->Pembeli;
            $penjualans->save();

            $jumlah = $product->Jumlah - $cart->qty;
            $product->update(['Jumlah' => $jumlah]);

            if($penjualans->Harga_Total > 2999) {
                $poin = floor($penjualans->Harga_Total / 3000);
                $user->update(['poin' => ($user->poin + $poin)]);
            }
        }

        

        Cart::destroy();

                Flash::success('Checkout Berhasil.');
               
               return redirect()->action('InventoryController@product');
    }

}
