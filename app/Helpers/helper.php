<?php
use Illuminate\Support\Str;

if (!function_exists('editSlug')) {
    function editSlug($text = ""){
        return Str::slug($text);
    }
}

if (!function_exists('app_settings')) {
    function app_settings(){
        static $settings = null;
        if ($settings == null) {
            $settings = \App\Models\Settings\SiteConfig::first();
        }
        return $settings;
    }
}

if (!function_exists('app_social')) {
    function app_social(){
        static $social = null;
        if ($social == null) {
            $social = \App\Models\Settings\SiteSocial::get();
        }
        return $social;
    }
}

if (!function_exists('getRightNavbar')) {
    function getRightNavbar()
    {
        $glob = glob(app_path() . '/Helpers/INC/Menu.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f = include $glob[0];
        $orderNum = $f;
        $checkRoles = [];
        foreach ($orderNum as $value) {
            array_push($checkRoles, $value);
        }
        $array = bubbleSort($checkRoles);
        return $array;
    }
}

if (!function_exists('bubbleSort')) {
    function bubbleSort($array)
    {
        if (!$length = count($array)) {
            return $array;
        }
        for ($outer = 0; $outer < $length; $outer++)
        {
            for ($inner = 0; $inner < $length; $inner++)
            {
                if ($array[$outer]['order'] < $array[$inner]['order'])
                {
                    $tmp = $array[$outer];
                    $array[$outer] = $array[$inner];
                    $array[$inner] = $tmp;
                }
            }
        }
        return $array;
    }
}

if (!function_exists('admin_can_any')) {
    function admin_can_any($table)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if(str_contains($value, $table)){
                $ch = 'true';
            }
        }
        return $ch;
    }
}
if (!function_exists('admin_can_item')) {
    function admin_can_item($table, $val)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if($value == $table.'.'.$val){
                $ch = 'true';
            }
        }
        return $ch;
    }
}

if (!function_exists('get_permissions')) {
    function get_permissions() {
        $glob = glob(app_path() . '/Helpers/INC/Permission.php');
        $array = include $glob[0];
        return $array;
    }
}

if (!function_exists('getReports')) {
    function getReports() {
        $glob = glob(app_path() . '/Helpers/INC/Main.php');
        $array = include $glob[0];
        return $array;
    }
}

if (!function_exists('permissionCheck')) {
    function permissionCheck($permission)
    {
        if (\Auth::guard('admin')->user() && \Auth::guard('admin')->user()->roles->first() && \Auth::guard('admin')->user()->roles->first()->permissions) {
            return in_array($permission,\Auth::guard('admin')->user()->roles->first()->permissions->pluck('name')->toArray());
        }else {
            return false;
        }
    }
}

if (!function_exists('app_languages')) {
    function app_languages()
    {
        $languages = config('laravellocalization.supportedLocales');
        return $languages;
    }
}

if (!function_exists('SubmitButton')) {
    function SubmitButton($title)
    {
        return "<button type=\"submit\" class=\"btn btn-primary pull-right\" style=\" top: 8px; \">".__($title)."<i class=\"icon-floppy-disk position-right\"></i></button>";
    }
}

if (!function_exists('BackButton')) {
    function BackButton($title, $route)
    {
        return "<a href=\"{$route}\" class=\"btn btn-secondary pull-right\" style=\" top: 8px; \">".__($title)."</a>";
    }
}

if (!function_exists('assetAdmin')) {
    function assetAdmin($value, $type = 'css')
    {
        // return ($type == 'css') ? '<link href="'.env("APP_URL").'assets/admin/' . $value . '" rel="stylesheet" type="text/css">' : '<script src="'.env("APP_URL").'assets/admin/' . $value . '"></script>';
        return ($type == 'css') ? '<link href="'.url('/').'/assets/admin/' . $value . '" rel="stylesheet" type="text/css">' : '<script src="'.url('/').'/assets/admin/' . $value . '"></script>';
    }
}

if (!function_exists('table_width_head')) {
    function table_width_head($count)
    {
        return "style=\"text-align:center;width: calc({$count} * 25px);\"";
    }
}

if (!function_exists('contactTypes')) {
    function contactTypes()
    {
        return [
            // 'whats' => 'واتس اب',
            'tiktok' => 'تيكتوك',
            'facebook' => 'فيس بوك',
            'twitter' => 'تويتر',
            'google' => 'جوجل بلس',
            'youtube' => 'يوتيوب',
            'instagram' => 'انستجرام',
            'linkedin' => 'لينك ان',
            'snapchat-ghost' => 'سناب شات'
        ];
    }
}

if (!function_exists('contactIcons')) {
    function contactIcons()
    {
        return [
            // 'whats' => 'fab fa-whatsapp',
            'tiktok' => 'fab fa-tiktok',
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'google' => 'fab fa-google-plus-g',
            'youtube' => 'fab fa-youtube',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            'snapchat-ghost' => 'fab fa-snapchat-ghost',
        ];
    }
}

if (!function_exists('generate_code')) {
    function generate_code()
    {
        // return random_int(1000, 9999);
        return 1234;
    }
}

// if (!function_exists('api_response')) {
//     function api_response($msg = '' , $data = [] , $pagination = null ){
//         if ( $data == [] ){
//             return [
//                 'message'   => $msg ,
//                 'data'      => []
//             ];
//         }
//         if ($pagination == null ){
//             return [
//                 'message'   => $msg ,
//                 'data'      => $data
//             ];
//         }else{
//             return [
//                 'message'   => $msg ,
//                 'data'      => $data ,
//                 'pagination' => [
//                     'total' => $pagination->total(),
//                     'count' => $pagination->count(),
//                     'perPage' => $pagination->perPage(),
//                     'currentPage' => $pagination->currentPage(),
//                     'lastPage' => $pagination->lastPage(),
//                     'hasMorePages' => $pagination->hasMorePages(),
//                 ]
//             ];
//         }

//     }
// }

if (!function_exists('api_msg')) {
    function api_msg($request,$ar,$en){
        if($request->header('Accept-Language') == "ar"){
            app()->setLocale('ar');
            $msg = $ar;
        }else{
            app()->setLocale('en');
            $msg = $en;
        }
        return $msg ;
    }
}

if (!function_exists('check_locale')) {
    function check_locale($ar,$en){
        if(app()->getLocale() == "ar"){
            app()->setLocale('ar');
            $msg = $ar;
        }else{
            app()->setLocale('en');
            $msg = $en;
        }
        return $msg ;
    }
}

if (!function_exists('api_model_set_paginate')) {

    function api_model_set_paginate($model)
    {
        return [
            'total'         => $model->total(),
            'count'         => $model->count(),
            'perPage'       => $model->perPage(),
            'currentPage'   => $model->currentPage(),
            'lastPage'      => $model->lastPage(),
            'hasMorePages'  => $model->hasMorePages(),
        ];
    }
}


if (!function_exists('get_server_ip')) {
    function get_server_ip() {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip();
    }
}

if (!function_exists('trackking_info')) {
    function trackking_info($value = NULL) {
        $data = [
            'AY-0001'=>[
                'code'              => 'AY-0001',
                'status_ar'         => 'تم إصدار بوليصة شحن(لم تستلم)',
                'status_en'         => 'AWB created at origin',
                'description_ar'    => 'تم إصدار بوليصة شحن لدى الشركة الشاحنة لكن لم تستلم من قبل "أي مكان "',
                'description_en'    => 'Shipment is created at collection point',
                'order_status'      => \App\Models\Orders\Order::STATUS_IN_PROCESS,
            ],
            'AY-0002'=>[
                'code'              => 'AY-0002',
                'status_ar'         => 'تم إصدار بوليصة شحن(لم تستلم)',
                'status_en'         => 'Picked from Collection Point',
                'description_ar'    => 'تم إصدار بوليصة شحن لدى الشركة الشاحنة لكن لم تستلم من قبل "أي مكان "',
                'description_en'    => 'Shipment is created at collection point',
                'order_status'      => \App\Models\Orders\Order::STATUS_IN_PROCESS,
            ],
            'AY-0032'=>[
                'code'              => 'AY-0032',
                'status_ar'         => 'معلقة',
                'status_en'         => 'Pending',
                'description_ar'    => 'الشحنة معلقة',
                'description_en'    => 'Shipment is pending',
                'order_status'      => \App\Models\Orders\Order::STATUS_IN_PROCESS,
            ],
            'AY-0004'=>[
                'code'              => 'AY-0004',
                'status_ar'         => 'الشحنة خارجة للتوصيل',
                'status_en'         => 'Out for Delivery',
                'description_ar'    => 'الشحنة خارجة للتوصيل للوجة النهائية',
                'description_en'    => 'Shipment is out for its final destination.',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0006'=>[
                'code'              => 'AY-0006',
                'status_ar'         => 'لم يتم التوصيل',
                'status_en'         => 'Not Delivered',
                'description_ar'    => 'تمت المحاولة لتوصيل الشحنة ، لم يتم توصيل الشحنة',
                'description_en'    => 'Shipment was not delivered.',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0009'=>[
                'code'              => 'AY-0009',
                'status_ar'         => 'في النقل',
                'status_en'         => 'In-Transit',
                'description_ar'    => 'الشحنة في النقل',
                'description_en'    => 'Shipment is in transit',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0010'=>[
                'code'              => 'AY-0010',
                'status_ar'         => 'شحنة مؤجلة',
                'status_en'         => 'Delayed',
                'description_ar'    => 'تم تأجيل الشحنة من قبل المستلم',
                'description_en'    => 'Shipment is delayed upon customer request. ',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0013'=>[
                'code'              => 'AY-0013',
                'status_ar'         => 'Missing info Phone number/ Address',
                'status_en'         => 'Missing info Phone number/ Address',
                'description_ar'    => 'Missing info Phone number/ Address',
                'description_en'    => 'Missing info Phone number/ Address',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-22'=>[
                'code'              => 'AY-22',
                'status_ar'         => 'تم تسليم الشحنة',
                'status_en'         => 'Shipment handed over',
                'description_ar'    => 'تم تسليم الشحنة',
                'description_en'    => 'Shipment handed over',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0026'=>[
                'code'              => 'AY-0026',
                'status_ar'         => 'Received at Riyadh Warehouse',
                'status_en'         => 'Received at Riyadh Warehouse',
                'description_ar'    => 'Received at Riyadh Warehouse',
                'description_en'    => 'Received at Riyadh Warehouse',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0027'=>[
                'code'              => 'AY-0027',
                'status_ar'         => 'Received at Qaseem Warehouse',
                'status_en'         => 'Received at Qaseem Warehouse',
                'description_ar'    => 'Received at Qaseem Warehouse',
                'description_en'    => 'Received at Qaseem Warehouse',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0030'=>[
                'code'              => 'AY-0030',
                'status_ar'         => 'تم إستلام الشحنة في مركز توزيع جدة',
                'status_en'         => 'Received at JED WH',
                'description_ar'    => 'تم إستلام الشحنة في مركز توزيع جدة',
                'description_en'    => 'Received at JED WH',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0034'=>[
                'code'              => 'AY-0034',
                'status_ar'         => 'تم استلام الشحنة في مركز توزيع الدمام',
                'status_en'         => 'Received at DMM WH',
                'description_ar'    => 'تم استلام الشحنة في مركز توزيع الدمام',
                'description_en'    => 'Received at DMM WH',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0005'=>[
                'code'              => 'AY-0005',
                'status_ar'         => 'تم التوصيل',
                'status_en'         => 'Delivered',
                'description_ar'    => 'تم توصيل الشحنة',
                'description_en'    => 'Shipment is delivered to customer',
                'order_status'      => \App\Models\Orders\Order::STATUS_DELIVERED,
            ],
            'AY-0008'=>[
                'code'              => 'AY-0008',
                'status_ar'         => 'تم إرجاع الشحنة',
                'status_en'         => 'Returned',
                'description_ar'    => 'تم إرجاع الشحنة للشاحن',
                'description_en'    => 'Shipment is returned to shipper',
                'order_status'      => \App\Models\Orders\Order::STATUS_RESTORED,
            ],
            'AY-0017'=>[
                'code'              => 'AY-0017',
                'status_ar'         => 'Received Back in Warehouse',
                'status_en'         => 'Received Back in Warehouse',
                'description_ar'    => 'Received Back in Warehouse',
                'description_en'    => 'Received Back in Warehouse',
                'order_status'      => \App\Models\Orders\Order::STATUS_RESTORED,
            ],
            'AY-0028'=>[
                'code'              => 'AY-0028',
                'status_ar'         => 'Out for Return to Shipper',
                'status_en'         => 'Out for Return to Shipper',
                'description_ar'    => 'Out for Return to Shipper',
                'description_en'    => 'Out for Return to Shipper',
                'order_status'      => \App\Models\Orders\Order::STATUS_RESTORED,
            ],
            'AY-0011'=>[
                'code'              => 'AY-0011',
                'status_ar'         => 'ملغي',
                'status_en'         => 'Cancelled',
                'description_ar'    => 'تم إلغاء الشحنة',
                'description_en'    => 'shipment was cancelled',
                'order_status'      => \App\Models\Orders\Order::STATUS_CANCELLED,
            ],
            'AY-0007'=>[
                'code'              => 'AY-0007',
                'status_ar'         => 'ملغي',
                'status_en'         => 'Cancelled',
                'description_ar'    => 'تم إلغاء الشحنة',
                'description_en'    => 'shipment was cancelled',
                'order_status'      => \App\Models\Orders\Order::STATUS_CANCELLED,
            ],
            'AY-0029'=>[
                'code'              => 'AY-0029',
                'status_ar'         => 'Pickup Cancelled',
                'status_en'         => 'Pickup Cancelled',
                'description_ar'    => 'Pickup Cancelled',
                'description_en'    => 'Pickup Cancelled',
                'order_status'      => \App\Models\Orders\Order::STATUS_CANCELLED,
            ],
        ];
        if ($value == NULL) {
            return $data;
        }else{
            if (isset($data[$value])) {
                return $data[$value];
            }else{
                return "Error";
            }
        }
    }
}
