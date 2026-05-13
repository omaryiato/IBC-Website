<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Services\Dashboard\SettingService;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function index()
    {
        $settings_list = $this->settingService->getSettingsList();

        return ResponseHelper::success(
            SettingResource::collection($settings_list),
            [
                "en" => "Settings Returned Successfully.",
                "ar" => "تم ارجاع الصفحات بنجاح"
            ],
            200
        );
    }

    public function show(int $id)
    {
        $setting_details = $this->settingService->getSettingById($id);

        if (!$setting_details) {
            return ResponseHelper::error($setting_details, "Setting not found!", 404);
        }

        return ResponseHelper::success(
            new SettingResource($setting_details),
            "Setting Returned Successfully.",
            200
        );
    }

    public function store(Request $request)
    {
        try{
            $setting_details = $this->settingService->addNewSetting($request->all());

            return ResponseHelper::success(
                new SettingResource($setting_details),
                "Setting created successfully.",
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $setting_details = $this->settingService->updateSetting($request->all(), $id);

            return ResponseHelper::success(
                new SettingResource($setting_details),
                "Setting Updated Successfully.",
                201
            );
        } catch (Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }

    // DELETE /Setting/{id}
    public function destroy(int $id)
    {
        try {
            $this->settingService->deleteSetting($id);

            return ResponseHelper::success(null, "Setting Deleted Successfully", 200);
        } catch (Exception $exception) {
            return ResponseHelper::error("Somthing went wrong!", $exception->getMessage(), 500);
        }
    }
}
