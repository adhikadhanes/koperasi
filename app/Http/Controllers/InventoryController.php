<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Repositories\InventoryRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Inventory;
use Storage;

class InventoryController extends AppBaseController
{
    /** @var  InventoryRepository */
    private $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepo)
    {
        $this->inventoryRepository = $inventoryRepo;
    }

    /**
     * Display a listing of the Inventory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inventoryRepository->pushCriteria(new RequestCriteria($request));
        $inventories = $this->inventoryRepository->all();

        return view('inventories.index')
            ->with('inventories', $inventories);
    }

    /**
     * Show the form for creating a new Inventory.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created Inventory in storage.
     *
     * @param CreateInventoryRequest $request
     *
     * @return Response
     */
    public function store(CreateInventoryRequest $request)
    {
        $input = $request->all();

        $fileName ='';
        if($request->hasFile('file')){
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();
            $request->file = $fileName;


            $imageName = $fileName ;

            $request->file('file')->move(
                base_path() . '/public/uploads/', $imageName
            );

        }

        $inventory = Inventory::create(array('Nama' => $request->Nama, 'Jumlah' => $request->Jumlah, 'Harga' => $request->Harga, 'file' => $fileName));


        Flash::success('Inventory saved successfully.');

        return redirect(route('inventories.index'));
    }

    /**
     * Display the specified Inventory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        return view('inventories.show')->with('inventory', $inventory);
    }

    /**
     * Show the form for editing the specified Inventory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        return view('inventories.edit')->with('inventory', $inventory);
    }

    /**
     * Update the specified Inventory in storage.
     *
     * @param  int              $id
     * @param UpdateInventoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInventoryRequest $request)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        $inventory = $this->inventoryRepository->update($request->all(), $id);

        Flash::success('Inventory updated successfully.');

        return redirect(route('inventories.index'));
    }

    /**
     * Remove the specified Inventory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inventory = $this->inventoryRepository->findWithoutFail($id);

        if (empty($inventory)) {
            Flash::error('Inventory not found');

            return redirect(route('inventories.index'));
        }

        $this->inventoryRepository->delete($id);

        Flash::success('Inventory deleted successfully.');

        return redirect(route('inventories.index'));
    }
}
