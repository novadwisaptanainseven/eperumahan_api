<?php

namespace App\Exports;

use App\Models\Pengembang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerumahanExport implements FromView, WithStyles, WithColumnWidths, WithEvents
{
    private $user;
    private $perumahan;

    public function __construct($user)
    {
        $this->user = $user;
        $this->perumahan = Pengembang::getAll3();
    }
}
