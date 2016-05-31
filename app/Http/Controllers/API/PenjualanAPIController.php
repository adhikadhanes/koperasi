<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePenjualanAPIRequest;
use App\Http\Requests\API\UpdatePenjualanAPIRequest;
use App\Models\Penjualan;
use App\Repositories\PenjualanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PenjualanController
 * @package App\Http\Controllers\API
 */

class PenjualanAPIController extends AppBaseController
{
    /** @var  PenjualanRepository */
    private $penjualanRepository;

    public function __construct(PenjualanRepository $penjualanRepo)
    {
        $this->penjualanRepository = $penjualanRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/penjualans",
     *      summary="Get a listing of the Penjualans.",
     *      tags={"Penjualan"},
     *      description="Get all Penjualans",
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
     *                  @SWG\Items(ref="#/definitions/Penjualan")
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
        $this->penjualanRepository->pushCriteria(new RequestCriteria($request));
        $this->penjualanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $penjualans = $this->penjualanRepository->all();

        return $this->sendResponse($penjualans->toArray(), 'Penjualans retrieved successfully');
    }

    /**
     * @param CreatePenjualanAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/penjualans",
     *      summary="Store a newly created Penjualan in storage",
     *      tags={"Penjualan"},
     *      description="Store Penjualan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Penjualan that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Penjualan")
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
     *                  ref="#/definitions/Penjualan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePenjualanAPIRequest $request)
    {
        $input = $request->all();

        $penjualans = $this->penjualanRepository->create($input);

        return $this->sendResponse($penjualans->toArray(), 'Penjualan saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/penjualans/{id}",
     *      summary="Display the specified Penjualan",
     *      tags={"Penjualan"},
     *      description="Get Penjualan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Penjualan",
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
     *                  ref="#/definitions/Penjualan"
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
        /** @var Penjualan $penjualan */
        $penjualan = $this->penjualanRepository->find($id);

        if (empty($penjualan)) {
            return Response::json(ResponseUtil::makeError('Penjualan not found'), 400);
        }

        return $this->sendResponse($penjualan->toArray(), 'Penjualan retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePenjualanAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/penjualans/{id}",
     *      summary="Update the specified Penjualan in storage",
     *      tags={"Penjualan"},
     *      description="Update Penjualan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Penjualan",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Penjualan that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Penjualan")
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
     *                  ref="#/definitions/Penjualan"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePenjualanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Penjualan $penjualan */
        $penjualan = $this->penjualanRepository->find($id);

        if (empty($penjualan)) {
            return Response::json(ResponseUtil::makeError('Penjualan not found'), 400);
        }

        $penjualan = $this->penjualanRepository->update($input, $id);

        return $this->sendResponse($penjualan->toArray(), 'Penjualan updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/penjualans/{id}",
     *      summary="Remove the specified Penjualan from storage",
     *      tags={"Penjualan"},
     *      description="Delete Penjualan",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Penjualan",
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
        /** @var Penjualan $penjualan */
        $penjualan = $this->penjualanRepository->find($id);

        if (empty($penjualan)) {
            return Response::json(ResponseUtil::makeError('Penjualan not found'), 400);
        }

        $penjualan->delete();

        return $this->sendResponse($id, 'Penjualan deleted successfully');
    }
}
