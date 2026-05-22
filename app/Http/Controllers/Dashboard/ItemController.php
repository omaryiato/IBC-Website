<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\AddNewItem;
use App\Http\Requests\Item\UpdateItem;
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
            [
                'en' => __('validation.get_items_list'),
                'ar' => __('validation.get_items_list'),
            ],
            200
        );

    }

    public function show(int $id)
    {
        $item_details = $this->itemService->getItemById($id);

        if (!$item_details) {
            return ResponseHelper::error(
                $item_details,
                [
                    'en' => __('validation.item_not_found'),
                    'ar' => __('validation.item_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new ItemResource($item_details),
            [
                'en' => __('validation.get_item_details'),
                'ar' => __('validation.get_item_details'),
            ],
            200
        );
    }

    public function store(AddNewItem $request)
    {
        try{
            $item_details = $this->itemService->addNewItem($request);

            return ResponseHelper::success(
                new ItemResource($item_details),
                [
                    'en' => __('validation.add_new_item'),
                    'ar' => __('validation.add_new_item'),
                ],
                201
            );

        } catch(\Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }

    public function update(UpdateItem $request, int $id)
    {
        try {
            $item_details = $this->itemService->updateItem($request, $id);

            if (!$item_details) {
                return ResponseHelper::error(
                    $item_details,
                    [
                        'en' => __('validation.item_not_found'),
                        'ar' => __('validation.item_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                new ItemResource($item_details),
                [
                    'en' => __('validation.update_item'),
                    'ar' => __('validation.update_item'),
                ],
                201
            );
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

    // DELETE /page/{id}
    public function destroy(int $id)
    {
        try {
            $item_details = $this->itemService->deleteItem($id);

            if (!$item_details) {
                return ResponseHelper::error(
                    $item_details,
                    [
                        'en' => __('validation.item_not_found'),
                        'ar' => __('validation.item_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                null,
                [
                    'en' => __('validation.delete_item'),
                    'ar' => __('validation.delete_item'),
                ],
                200);
        } catch (\Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => __('validation.exception_error'),
                    'ar' => __('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }
}
