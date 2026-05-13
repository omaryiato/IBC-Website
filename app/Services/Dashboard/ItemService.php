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

    public function addNewItem(array $item_request)
    {
        return $this->itemRepository->addNewItem($item_request);
    }

    public function updateItem(array $item_request, int $id)
    {
        $item_details = $this->itemRepository->getItemById($id);
        return $this->itemRepository->updateItem($item_details, $item_request);
    }
    public function deleteItem(int $id)
    {
        $item_details = $this->itemRepository->getItemById($id);
        return $this->itemRepository->deleteItem($item_details);
    }
}
