<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentRepository\OrderRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderRepository $orderRepos;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepos = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                $this->orderRepos->all()
            ]);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {

            $orderDetails = $request->only(['details', 'client']);

            $newOrder = $this->orderRepos->create($orderDetails);

//            return redirect()->action(
//                [OrderController::class, 'show'], ['order' => $newOrder]);
            return response()->json($newOrder, Response::HTTP_CREATED);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            return response()->json([$this->orderRepos->find($id)], 201);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $orderDetails = $request->only(['details', 'client', 'is_fulfilled']);
            $order = $this->orderRepos->find($id);
            if (!is_null($order)) {
                $this->orderRepos->update($id, $orderDetails);

                return response()->json(null, Response::HTTP_NO_CONTENT);
            }

            return response()->json('Resource not found', Response::HTTP_NOT_FOUND);
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $orderDetail = $this->orderRepos->find($id);
            if (!is_null($orderDetail)) {
                $this->orderRepos->delete($id);

                return response()->json(null, Response::HTTP_ACCEPTED);
            }

            return response()->json('Bad request', Response::HTTP_BAD_REQUEST);
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
