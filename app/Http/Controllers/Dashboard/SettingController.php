<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\AddNewSetting;
use App\Http\Requests\Setting\UpdateSetting;
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
                'en' => trans('validation.get_settings_list'),
                'ar' => trans('validation.get_settings_list'),
            ],
            200
        );
    }

    public function show(int $id)
    {
        $setting_details = $this->settingService->getSettingById($id);

        if (!$setting_details) {
            return ResponseHelper::error(
                $setting_details,
                [
                    'en' => trans('validation.setting_not_found'),
                    'ar' => trans('validation.setting_not_found'),
                ],
                404);
        }

        return ResponseHelper::success(
            new SettingResource($setting_details),
            [
                'en' => trans('validation.get_setting_details'),
                'ar' => trans('validation.get_setting_details'),
            ],
            200
        );
    }

    public function store(AddNewSetting $request)
    {
        try{
            $setting_details = $this->settingService->addNewSetting($request->all());

            return ResponseHelper::success(
                new SettingResource($setting_details),
                [
                    'en' => trans('validation.add_new_setting'),
                    'ar' => trans('validation.add_new_setting'),
                ],
                201
            );

        } catch(Exception $exception){
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }

    }

    public function update(UpdateSetting $request, int $id)
    {
        try {
            $setting_details = $this->settingService->updateSetting($request->all(), $id);

            if (!$setting_details) {
                return ResponseHelper::error(
                    $setting_details,
                    [
                        'en' => trans('validation.setting_not_found'),
                        'ar' => trans('validation.setting_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                new SettingResource($setting_details),
                [
                    'en' => trans('validation.update_setting'),
                    'ar' => trans('validation.update_setting'),
                ],
                201
            );
        } catch (Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }

    // DELETE /Setting/{id}
    public function destroy(int $id)
    {
        try {
            $setting_details = $this->settingService->deleteSetting($id);

            if (!$setting_details) {
                return ResponseHelper::error(
                    $setting_details,
                    [
                        'en' => trans('validation.setting_not_found'),
                        'ar' => trans('validation.setting_not_found'),
                    ],
                    404);
            }

            return ResponseHelper::success(
                null,
                [
                    'en' => trans('validation.delete_setting'),
                    'ar' => trans('validation.delete_setting'),
                ],
                200);
        } catch (Exception $exception) {
            return ResponseHelper::error(
                [
                    'en' => trans('validation.exception_error'),
                    'ar' => trans('validation.exception_error'),
                ],
                $exception->getMessage(),
                500);
        }
    }
}
