<?php

namespace App\Support;
use Barryvdh\DomPDF\Facade\Pdf;

class CreatePdfFile
{
    protected $pdf;
    protected $size;
    protected $type;

    public function getPdf($content, $data)
    {
        $this->pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($content, $data);
        return $this;
    }
    public function setPaper(string $size = 'A4', string $type = 'portrait')
    {
        $this->size = $size;
        $this->type = $type;
        $this->pdf = $this->pdf->setPaper($size, $type);
        return $this;
    }
    public function build()
    {
        return $this->pdf;
    }
}
