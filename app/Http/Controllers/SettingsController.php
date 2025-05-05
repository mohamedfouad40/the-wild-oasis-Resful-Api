<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\UpdateSettingsRequest;
use App\Models\Setting;
use App\Traits\GetResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use GetResponse;
    public function settings(){
        $settings = Setting::find(1);

        return $this->dataResponse($settings,'Success');
    }

    public function update(UpdateSettingsRequest $request){
        $settings = Setting::find(1);
        $settings->update($request->all());
        return $this->dataResponse($request->all(),'Success');
    }
}
