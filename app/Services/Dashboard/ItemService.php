<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ItemRepository;

class ItemService extends BaseService
{
    public function __construct(
        protected ItemRepository $itemRepository
    ) {}

    public function getItemsList()
    {
        return $this->itemRepository->all();
    }

    public function getItemById(int $id)
    {
        $item_details = $this->itemRepository->findOrFail($id);

        if (!$item_details) {
            return null;
        }

        return $item_details;
    }

    public function createItem(array $item_request)
    {
        return $this->itemRepository->create($item_request);
    }

    public function updateItem(int $id, array $item_request)
    {
        return $this->itemRepository->update($id, $item_request);
    }
    public function deleteItem(int $id)
    {
        return $this->itemRepository->delete($id);
    }
}
