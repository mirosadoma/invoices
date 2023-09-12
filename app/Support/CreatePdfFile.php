<?php

namespace App\Support;

// use App\Models\ContractTemplate;
// use Illuminate\Support\Facades\Storage;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;

class CreatePdfFile
{
    public $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf(['tempDir'=>storage_path('tempdir')]);
    }

    public function getPdf($content, $orientation = 'L')
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $this->mpdf = new Mpdf([
            'tempDir'=>storage_path('tempdir'),
            'margin_left'   => 0,
            'margin_right'  => 0,
            'margin_top'    => 0,
            'margin_bottom' => 0,

            'fontDir' => array_merge($fontDirs, [
                resource_path() . '/fonts/mpdf',
            ]),
            'fontdata' => $fontData + [
                "cairo" => [
                    'R' => "Cairo-Regular.ttf",
                    'B' => "Cairo-Bold.ttf",
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
                "notokufi" => [
                    'R' => "NotoKufiArabic-Regular.ttf",
                    'B' => "NotoKufiArabic-Bold.ttf",
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ]
            ],
            'orientation' => $orientation
        ]);

        $this->mpdf->SetCreator(env('APP_NAME'));
        $this->mpdf->SetDisplayMode('fullpage');
        $content_array = str_split($content, 900000);

        foreach ($content_array as $part) {
            $this->mpdf->WriteHTML($part);
        }
        return $this->mpdf;
    }
    // public function setWaterMark(string $img, $alpha = 0.15, $size = 'D')
    // {
    //     $this->mpdf->SetWatermarkImage($img, $alpha, $size);
    //     $this->mpdf->showWatermarkImage = true;

    //     return $this->mpdf;
    // }


    // protected function getContractTempleteImg($req = 'watermark')
    // {
    //     $twmplete = ContractTemplate::first();
        // if ($req == 'watermark') {
        //     $path = ContractTemplate::$default_water_mark_path;
        //     if ($twmplete && Storage::disk('s3')->exists($twmplete->school_watermark)) {
        //         $path = Storage::disk('s3')->url($twmplete->school_watermark);
        //     }
        // } elseif ($req == 'logo') {
        //     $path = ContractTemplate::$default_logo_path;
        //     if ($twmplete && Storage::disk('s3')->exists($twmplete->school_logo)) {
        //         $path = Storage::disk('s3')->url($twmplete->school_logo);
        //     }
        // }
    //     return $path;
    // }
}
