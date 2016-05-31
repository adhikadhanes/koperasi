<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBarangAPIRequest;
use App\Http\Requests\API\UpdateBarangAPIRequest;
use App\Models\Barang;
use App\Repositories\BarangRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BarangController
 * @package App\Http\Controllers\API
 */

class BarangAPIController extends AppBaseController
{
    /** @var  BarangRepository */
    private $barangRepository;

    public function __construct(BarangRepository $barangRepo)
    {
        $this->barangRepository = $barangRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/barangs",
     *      summary="Get a listing of the Barangs.",
     *      tags={"Barang"},
     *      description="Get all Barangs",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Barang")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->barangRepository->pushCriteria(new RequestCriteria($request));
        $this->barangRepository->pushCriteria(new LimitOffsetCriteria($request));
        $barangs = $this->barangRepository->all();

        return $this->sendResponse($barangs->toArray(), 'Barangs retrieved successfully');
    }

    /**
     * @param CreateBarangAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/barangs",
     *      summary="Store a newly created Barang in storage",
     *      tags={"Barang"},
     *      description="Store Barang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Barang that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Barang")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Barang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBarangAPIRequest $request)
    {
        $input = $request->all();

        $barangs = $this->barangRepository->create($input);

        return $this->sendResponse($barangs->toArray(), 'Barang saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/barangs/{id}",
     *      summary="Display the specified Barang",
     *      tags={"Barang"},
     *      description="Get Barang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Barang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return Response::json(ResponseUtil::makeError('Barang not found'), 400);
        }

        return $this->sendResponse($barang->toArray(), 'Barang retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBarangAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/barangs/{id}",
     *      summary="Update the specified Barang in storage",
     *      tags={"Barang"},
     *      description="Update Barang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Barang that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Barang")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Barang"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBarangAPIRequest $request)
    {
        $input = $request->all();

        /** @var Barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return Response::json(ResponseUtil::makeError('Barang not found'), 400);
        }

        $barang = $this->barangRepository->update($input, $id);

        return $this->sendResponse($barang->toArray(), 'Barang updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/barangs/{id}",
     *      summary="Remove the specified Barang from storage",
     *      tags={"Barang"},
     *      description="Delete Barang",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Barang",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Barang $barang */
        $barang = $this->barangRepository->find($id);

        if (empty($barang)) {
            return Response::json(ResponseUtil::makeError('Barang not found'), 400);
        }

        $barang->delete();

        return $this->sendResponse($id, 'Barang deleted successfully');
    }
}
