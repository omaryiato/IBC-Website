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
        return $this->settingRepository->addNewSetting($this->prepareSettingDetails($setting_request));
    }

    public function updateSetting(array $setting_request, int $id)
    {
        $setting_details = $this->settingRepository->getSettingById($id);

        if (!$setting_details) {
            return null;
        }

        $setting_request = $this->prepareSettingDetails($setting_request);
        return $this->settingRepository->updateSetting($setting_details, $setting_request);
    }
    public function deleteSetting(int $id)
    {
        $setting_details = $this->settingRepository->getSettingById($id);

        if (!$setting_details) {
            return null;
        }

        return $this->settingRepository->deleteSetting($setting_details);
    }

    public function prepareSettingDetails(array $setting_request) : array
    {
        return  [
            'key' => $setting_request['key'],
            'value' => json_decode($setting_request['value'], true) ?? null,
            'created_by' => $setting_request['created_by'],
            'updated_by' => $setting_request['updated_by'],
        ];
    }
}
