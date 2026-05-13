<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;
use App\Repositories\Dashboard\BaseRepository;

class SettingRepository
{

    public function getSettingsList()
    {
        return Setting::with(['page','items','media'])->get();
    }

    public function getSettingById(int $id)
    {
        return Setting::with(['page','items','media'])->findOrFail($id);
    }


    public function addNewSetting(array $setting_request)
    {
        return Setting::create($setting_request);
    }

    public function updateSetting(Setting $setting, array $setting_request)
    {
        $setting->update($setting_request);
        return $setting;
    }

    public function deleteSetting(Setting $setting)
    {
        return $setting->delete();
    }
}
