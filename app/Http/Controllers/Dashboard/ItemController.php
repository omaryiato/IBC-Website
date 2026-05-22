<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Services\Dashboard\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(
        protected ItemService $itemService
    ) {}

    public function index()
    {
        $items_list = $this->itemService
                ->getItemsList();

        return ResponseHelper::success(
            ItemResource::collection($items_list),
            "Items Returned Successfully.",
            200
        );

    }

    public function show(int $id)
    {
        $item_details = $this->itemService->getItemById($id);

        if (!$item_details) {
            return ResponseHelper::error($item_details, "Item not found!", 404);
        }

        return ResponseHelper::success(
            new ItemResource($item_details),
            "Item Added Successfully.",
            200
        );
    }

    public function store(Request $request)
    {
        try{
            $item_details = $this->itemService->addNewItem($request);

            return ResponseHelper::success(
                new ItemResource($item_details),
                "Items Returned Successfully.",
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $item_details = $this->itemService->updateItem($request, $id);

            return ResponseHelper::success(
                new ItemResource($item_details),
                "Item Updated Successfully.",
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $this->itemService->deleteItem($id);

            return ResponseHelper::success(null, "Item Deleted Successfully", 200);
        } catch (\Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }
}
