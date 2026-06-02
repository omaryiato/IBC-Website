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
        return $this->itemRepository->addNewItem($this->prepareItemDetails($item_request));
    }

    public function updateItem($request, int $id)
    {
        $item_request = $request->all();
        $item_details = $this->itemRepository->getItemById($id);

        if (!$item_details) {
            return null;
        }

        if ($request->hasFile('media')) {

            if (!empty($item_details->media_id)) {
                $this->mediaService->deleteMedia($item_details->media_id);
            }

            $media_id = $this->mediaService->prepareMedia($request->file('media'),'sections');

            $item_request['media_id'] = $media_id;

        }

        $item_request = $this->prepareItemDetails($item_request);

        return $this->itemRepository->updateItem($item_details, $item_request);
    }
    public function deleteItem(int $id)
    {
        $item_details = $this->itemRepository->getItemById($id);
        if (!$item_details) {
            return null;
        }
        return $this->itemRepository->deleteItem($item_details);
    }

    public function prepareItemDetails(array $item_request): array
    {
        $data = [

            'section_id' => $item_request['section_id'],

            'title' => !empty($item_request['title'])
                ? json_decode($item_request['title'], true)
                : null,

            'description' => !empty($item_request['description'])
                ? json_decode($item_request['description'], true)
                : null,

            'media_id' => $item_request['media_id'] ?? null,

            'link' => $item_request['link'] ?? null,

            'extra_data' => !empty($item_request['extra_data'])
                ? json_decode($item_request['extra_data'], true)
                : null,

            'sort_order' => $item_request['sort_order'] ?? 0,

            'item_code' => $item_request['item_code'],

            'is_active' => $item_request['is_active'] ?? 1,
        ];

        if (isset($item_request['created_by'])) {
            $data['created_by'] = $item_request['created_by'];
        }

        if (isset($item_request['updated_by'])) {
            $data['updated_by'] = $item_request['updated_by'];
        }

        return $data;
    }
}
