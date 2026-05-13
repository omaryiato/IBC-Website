<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SettingRepository;

class SettingService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    ) {}

    public function getSettingsList()
    {
        return $this->settingRepository->getSettingsList();
    }

    public function getSettingById(int $id)
    {
        $setting_details = $this->settingRepository->getSettingById($id);

        if (!$setting_details) {
            return null;
        }

        return $setting_details;
    }


    public function addNewSetting(array $setting_request)
    {
        return $this->settingRepository->addNewSetting($setting_request);
    }

    public function updateSetting(array $setting_request, int $id)
    {
        $setting_details = $this->settingRepository->getSettingById($id);
        return $this->settingRepository->updateSetting($setting_details, $setting_request);
    }
    public function deleteSetting(int $id)
    {
        $setting_details = $this->settingRepository->getSettingById($id);
        return $this->settingRepository->deleteSetting($setting_details);
    }
}
