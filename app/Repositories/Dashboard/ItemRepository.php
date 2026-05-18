<?php

namespace App\Repositories\Dashboard;

use App\Models\Item;
use App\Repositories\Dashboard\BaseRepository;

class ItemRepository
{
    public function getItemsList()
    {
        return Item::with(['section.media','media'])->get();
    }

    public function getItemById(int $id)
    {
        return Item::with(['section.media','media'])->findOrFail($id);
    }

    public function addNewItem(array $item_request)
    {
        return Item::create($item_request);
    }

    public function updateItem(Item $item, array $item_request)
    {
        $item->update($item_request);
        return $item;
    }

    public function deleteItem(Item $item)
    {
        return $item->delete();
    }
}
