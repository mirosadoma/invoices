<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Models
use App\Models\Settings\SiteConfig;
use App\Models\Settings\PaymentMethods;

class SettingsController extends Controller {

    public function config() {
        if (!permissionCheck('settings.config')) {
            return abort(403);
        }
        $setting = SiteConfig::first();
        return view('admin.settings.config',get_defined_vars());
    }

    public function update(Request $request, $type) {
        if (!permissionCheck('settings.update')) {
            return abort(403);
        }
        $data = $request->all();

        if($type == 'config'){
            Validator::make($request->all(),[
                // 'ar.title'                  => 'required|string|between:2,500',
                'en.title'                  => 'required|string|between:2,500',
                // 'ar.address'                => 'required|string|between:2,1000',
                'en.company_name'           => 'required|string|between:2,1000',
                // 'ar.payment_methods'   => 'required|string|between:2,1000',
                'en.payment_methods'   => 'nullable|string|between:2,1000',
                'email'                     => 'required|email:filter|between:2,200',
                'phone'                     => 'required',
                'tax'                       => 'required',
                'logo'                      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ],[],[
                'en.title'                  => __('Title'),
                'en.company_name'           => __('Company Name'),
                'en.payment_methods'   => __('Payment Methods'),
                'tax'                       => __('Tax'),
                'phone'                     => __('Phone'),
                'email'                     => __('Email'),
                'logo'                      => __('Logo'),
            ])->validate();
            $setting = SiteConfig::first();
            if (request()->has('logo') && $request->logo != NULL) {
                $data['logo']      = imageUpload($request->logo, 'settings', [], false, true, $setting->logo);
            }else{
                unset($data['logo']);
            }
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }
    }

    public function remove_logo($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->logo);
        $setting->update([
            'logo' => null
        ]);
        return response()->json([
            'message' => __('Logo Deleted Successfully'),
        ]);
    }
}
