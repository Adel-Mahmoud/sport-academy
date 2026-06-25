<?php

namespace App\Domains\Settings\Repositories;

use App\Domains\Settings\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingRepository
{
    public function all()
    {
        return Setting::all();
    }

    public function find($id)
    {
        return Setting::find($id);
    }

    public function save(array $data)
    {
        $model = Setting::first();

        if ($model) {
            if (isset($data['logo']) && $model->logo && Storage::disk('public')->exists($model->logo)) {
                Storage::disk('public')->delete($model->logo);
            }

            if (isset($data['brand_image']) && $model->brand_image && Storage::disk('public')->exists($model->brand_image)) {
                Storage::disk('public')->delete($model->brand_image);
            }

            $model->update($data);
        } else {
            $model = Setting::create($data);
        }

        return $model;
    }
}
