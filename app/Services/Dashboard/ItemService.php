<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ItemRepository;
use App\Services\Dashboard\MediaService;


class ItemService extends BaseService
{
    public function __construct(
        protected ItemRepository $itemRepository,
        protected MediaService $mediaService
    ) {}

    public function getItemsList()
    {
        return $this->itemRepository->getItemsList();
    }

    public function getItemById(int $id)
    {
        $item_details = $this->itemRepository->getItemById($id);

        if (!$item_details) {
            return null;
        }

        return $item_details;
    }

    public function addNewItem($request)
    {
        $item_request = $request->all();
        if ($request->hasFile('media')) {

            $media_id = $this->mediaService->prepareMedia($request->file('media'),'items');

            $item_request['media_id'] = $media_id;
        }
        return $this->itemRepository->addNewItem($item_request);
    }

    public function updateItem($request, int $id)
    {
        $item_request = $request->all();
        $item_details = $this->itemRepository->getItemById($id);

        if ($request->hasFile('media')) {

            if (!empty($item_details->media_id)) {
                $this->mediaService->deleteMedia($item_details->media_id);
            }

            $media_id = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $item_request['media_id'] = $media_id;

        }

        return $this->itemRepository->updateItem($item_details, $item_request);
    }
    public function deleteItem(int $id)
    {
        $item_details = $this->itemRepository->getItemById($id);
        return $this->itemRepository->deleteItem($item_details);
    }
}
