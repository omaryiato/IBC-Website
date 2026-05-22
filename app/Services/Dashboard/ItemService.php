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

    public function prepareItemDetails(array $item_details): array
    {
        return [

            'section_id' => $item_details['section_id'],

            'title' => !empty($item_details['title'])
                ? json_decode($item_details['title'], true)
                : null,

            'description' => !empty($item_details['description'])
                ? json_decode($item_details['description'], true)
                : null,

            'media_id' => $item_details['media_id'] ?? null,

            'link' => $item_details['link'] ?? null,

            'extra_data' => !empty($item_details['extra_data'])
                ? json_decode($item_details['extra_data'], true)
                : null,

            'sort_order' => $item_details['sort_order'] ?? 0,

            'is_active' => $item_details['is_active'] ?? 1,

            'created_by' => $item_details['created_by'] ?? null,

            'updated_by' => $item_details['updated_by'] ?? null,
        ];
    }
}
