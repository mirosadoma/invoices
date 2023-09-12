<?php

namespace App\Exports;

use App\Models\GomlaSections\GomlaSection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GomlaSectionsExport implements FromView
{

    public function view(): View
    {
        $all_data = [];
        $gomla_section = GomlaSection::all();
        foreach ($gomla_section as $value) {
            $all_data[] = $this->one_object($value);
        }
        return view('exports.gomla_sections', [
            'all_data' => $all_data
        ]);
    }

    private function one_object($data){
        $all = [
            'full_name'        => $data->full_name,
            'company_name'     => $data->company_name,
            'phone'            => $data->phone,
            'email'            => $data->email,
            'message'          => $data->message,
            'created_at'       => $data->created_at,
        ];
        return $all;

    }
}
