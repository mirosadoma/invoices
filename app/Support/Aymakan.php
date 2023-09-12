<?php

namespace App\Support;

use App\Models\Orders\Order;
use App\Models\Cities\City;
use App\Models\Settings\DeliveryAdderss;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

// For Delivery Charge Company
class Aymakan {

    // (new Aymakan())->createShipment($order_id)

    // ============================= //
    protected $apiUrl           = ""; // Aymakan Url

    protected $apiKey           = ""; // Aymakan apiKey
    // ============================= //
    protected $data             = []; // All Data Fileds
    protected $collection_data  = []; // All Data Of Owner Address
    protected $errors           = [];
    protected $method           = "POST"; // Method
    protected $orderNumber      = ""; // Order Number

    public function __construct() {
        if (env('AYMAKAN_LIVE', 'true') == "true") {
            $this->apiUrl       = env("AYMAKAN_API_URL");
            $this->apiKey       = env("AYMAKAN_SECRET_API_KEY");
        } else {
            $this->apiUrl       = env("AYMAKAN_TEST_API_URL");
            $this->apiKey       = env("AYMAKAN_TEST_SECRET_API_KEY");
        }
    }

    public function setData($order_id) {
        $order = Order::where('id', $order_id)->first();
        $this->orderNumber = $order->number;
        if ($this->getAddress() && isset($this->getAddress()['data']) && isset($this->getAddress()['data']['address']) && isset($this->getAddress()['data']['address'][0]) && $this->getAddress()['data']['address'][0]) {
            $this->collection_data = $this->getAddress()['data']['address'][0];
        }else{
            $this->data = [];
            $this->errors =  [
                'status'    => false,
                'msg'       => __('Please Add Collection Address First In Delivery Company'),
            ];
            return $this;
        }
        $this->data = [
            "requested_by"              => $order->user->name??'', // required
            "declared_value"            => $order->final_total, // required
            "declared_value_currency"   => "SAR", // not required
            "reference"                 => $order->number, // required
            "is_cod"                    => ($order->payment_method == "CashOnDelivery") ? 1 : 0, // required
            "cod_amount"                => ($order->payment_method == "CashOnDelivery") ? $order->final_total : 0,// if is_cod = 1 || if CashOnDelivery = 1
            "currency"                  => "SAR", // not required

            "delivery_name"             => $order->user->name??'', // required
            "delivery_email"            => $order->user->email??'', // not required
            "delivery_city"             => $order->address->city->translate('en')->name, // required
            "delivery_address"          => $order->address->city->translate('en')->name.', '.$order->address->district.', '.$order->address->building_number.', '.$order->address->floor_number.', '.$order->address->full_address, // not required
            "delivery_neighbourhood"    => $order->address->district, // not required
            "delivery_postcode"         => $order->address->postal_code, // not required
            "delivery_country"          => "SA",// not required
            "delivery_phone"            => $order->user->phone, // required
            "delivery_description"      => $order->address->full_address, // not required all products descriptions

            "collection_name"           => $this->collection_data['name'] ?? '',// required
            "collection_phone"          => $this->collection_data['phone'] ?? '',// required
            "collection_email"          => $this->collection_data['email'] ?? '',// not required
            "collection_city"           => $this->collection_data['city'] ?? '', // required
            "collection_address"        => $this->collection_data['address'] ?? '',// required
            "collection_neighbourhood"  => $this->collection_data['neighbourhood'] ?? '',// not required
            "collection_postcode"       => $this->collection_data['postcode'] ?? '',// not required
            "collection_country"        => "Saudi Arabia",// not required
            "collection_description"    => $this->collection_data['description'] ?? '',// not required

            // "collection_name"           => 'kafroaster',// required
            // "collection_email"          => 'marketing@kafroasters.net',// not required
            // "collection_city"           => 'Riyadh', // required
            // "collection_address"        => 'Riyadh',// required
            // "collection_neighbourhood"  => 'Riyadh',// not required
            // "collection_postcode"       => 12211,// not required
            // "collection_country"        => "SA",// not required
            // "collection_phone"          => '0564211109',// required
            // "collection_description"    => "Test Order",// not required

            "weight"                    => $order->weight_total,// not required
            "pieces"                    => $order->pieces, // required boxes number || delivery awb
            "items_count"               => $order->order_products->sum('quantity')// not required
        ];
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function geterrors() {
        return $this->errors;
    }

    public function createShipment($order_id){
        $this->setData($order_id);
        $fields = $this->getData();
        $checkReference = $this->checkReference($this->orderNumber);
        if ($checkReference && isset($checkReference['error']) && $checkReference['error'] == true) {
            return $this->callAPI('POST', $this->apiUrl."/shipping/create", $fields);
        }else{
            $this->errors =  [
                'status'    => false,
                'msg'       => __('Shipment Is Already Found'),
            ];
            return $this->geterrors();
        }
    }

    public function callAPI($method, $url = null, $all_data = []){
        if(count($this->geterrors())){
            return $this->geterrors();
        }
        $call = Http::withHeaders([
            "Accept"  => "application/json",
            "Authorization" => $this->apiKey
        ]);
        switch ($method) {
            case "POST":
                $result = $call->post($url,$all_data)->json();
                break;
            case "PUT":
                $result = $call->put($url,$all_data)->json();
                break;
            case "DELETE":
                $result = $call->delete($url,$all_data)->json();
                break;
            default:
                $result = $call->get($url)->json();
                break;
        }
        return $result;
    }

    public function checkReference($order_number){
        return $this->callAPI('GET', $this->apiUrl."/shipping/by_reference/".$order_number);
    }

    public function cancelShipping($order_number){
        $this->orderNumber = $order_number;
        $checkReference = $this->checkReference($this->orderNumber);
        if ($checkReference && isset($checkReference['error']) && $checkReference['error'] == true) {
            $this->errors =  [
                'status'    => false,
                'msg'       => __('Shipment Is Not Found'),
            ];
            return $this->geterrors();
        }else{
            return $this->callAPI('POST', $this->apiUrl."/shipping/cancel_by_reference/", ['reference'=>$order_number]);
        }
    }

    public function addAddress($address_fields = []){
        foreach ($address_fields as $key => $value) {
            unset($address_fields[$key]);
            if ($key == 'address_city') {
                $value = City::find($value)->translate('en')->name;
            }
            $address_fields[explode('address_', $key)[1]] = $value;
        }
        if ($this->getAddress() && isset($this->getAddress()['data']) && isset($this->getAddress()['data']['address']) && isset($this->getAddress()['data']['address'][0]) && $this->getAddress()['data']['address'][0]) {
            $address_fields['id'] = $this->getAddress()['data']['address'][0]['id'];
            $this->callAPI('PUT', $this->apiUrl."/address/update", $address_fields);
        } else {
            return $this->callAPI('POST', $this->apiUrl."/address/create", $address_fields);
        }
    }

    public function getAddress(){
        return $this->callAPI('GET', $this->apiUrl."/address/list");
    }

    public function createPickupRequest($order_number)
    {
        $avilable_date_time = $this->getTimeSlots();
        if ($avilable_date_time && isset($avilable_date_time['success']) && $avilable_date_time['success'] == true) {
            $time_slot = isset($avilable_date_time['data']['slots']['evening']) ? 'evening' : 'afternoon';
            $setting = DeliveryAdderss::first();
            $checkReference = $this->checkReference($order_number);
            if ($checkReference && isset($checkReference['success']) && $checkReference['success'] == true) {
                $pick_data = [
                    "reference"         => $checkReference['data']['shipments'][0]['tracking_number'],
                    "pickup_date"       => $avilable_date_time['data']['date'],
                    "time_slot"         => $time_slot,
                    "city"              => $setting->city->translate('en')->name ?? '',
                    "contact_name"      => $setting->address_name ?? '',
                    "contact_phone"     => $setting->address_phone ?? '',
                    "address"           => $setting->address_address ?? '',
                    "shipments"         => 1
                ];
                return $this->callAPI('POST', $this->apiUrl."/pickup_request/create",$pick_data);
            } else {
                $this->errors =  [
                    'status'    => false,
                    'msg'       => __('No order date has been set'),
                ];
                return $this->geterrors();
            }

        } else {
            $this->errors =  [
                'status'    => false,
                'msg'       => __('No order date has been set'),
            ];
            return $this->geterrors();
        }
    }

    public function reversePickup($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            $this->errors =  [
                'status'    => false,
                'msg'       => __('Order Not Found'),
            ];
            return $this->geterrors();
        }
        $this->setData($order->id);
        $fields = $this->getData();
        foreach ($order->products()->groupBy('product_id')->get() as $product) {
            $fields['products'][] =[
                "sku"=> $product->sku??"123",
                "qty"=> $order->order_products()->where('product_id', $product->id)->sum('quantity'),
                "price"=> $product->price * $order->order_products()->where('product_id', $product->id)->sum('quantity')
            ];
        }
        $checkReference = $this->checkReference($this->orderNumber);
        if ($checkReference && isset($checkReference['error']) && $checkReference['error'] == true) {
            $this->errors =  [
                'status'    => false,
                'msg'       => __('Shipment Is Already Found'),
            ];
            return $this->geterrors();
        }else{
            return $this->callAPI('POST', $this->apiUrl."/shipping/create/reverse_pickup", $fields);
        }
    }

    public function getTimeSlots($date = null)
    {
        // Date format should be "Y-m-d"
        $date = $date ? $date : Carbon::today();
        $formate = $date->format('Y-m-d');
        $check = $this->callAPI('GET', $this->apiUrl."/time_slots/".$formate);
        if ($check && isset($check['error']) && $check['error'] = true) {
            return $this->getTimeSlots($date->addDay());
        } else {
            return $check;
        }
    }

    public function trackShipment(array $tracking)
    {
        $tracking = implode(',', $tracking);
        return $this->callAPI('GET', $this->apiUrl . '/shipping/track/' . $tracking);
    }
}
