<?php

namespace App\Exports;

use App\Models\Perumahan;
use App\Models\Properti;
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

class BangunanExport implements FromView, WithStyles, WithColumnWidths, WithEvents
{
    private $user;
    private $bangunan;

    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->bangunan = Properti::GetAllBangunanVerifikasiExport($request);
    }

    public function view(): View
    {
        $currentDate = date("d/m/Y");

        return view('exports/bangunan-verifikasi', [
            'data' => $this->bangunan,
            'tanggal' => $currentDate,
            'user' => $this->user->username
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'bold' => true,
                    'size' => "12px"
                ]
            ],
            "A6:P7"    => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ],
                'font' => [
                    'bold' => true,
                    'size' => "12px"
                ]
            ],
            "6" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
                'font' => [
                    'bold' => true
                ]
            ],
            "A" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
            ],
            "C" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "E" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "F" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "G" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "I" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "J" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "K" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "L" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "M" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "N" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "O" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "P" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],

        ];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 35,
            'C' => 20,
            'D' => 35,
            'E' => 25,
            'F' => 20,
            'G' => 20,
            'H' => 35,
            'I' => 13,
            'J' => 13,
            'K' => 13,
            'L' => 13,
            'M' => 14,
            'N' => 14,
            'P' => 14,
            'Q' => 11,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set Title
                $title = "DATA VERIFIKASI BANGUNAN PENGEMBANG DI DINAS PERUMAHAN DAN PERMUKIMAN SAMARINDA";

                $event->sheet->mergeCells('A1:S2');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'DDDDDD',
                        ],
                    ]
                ]);

                $event->sheet->setCellValue("A1", $title);
                // $event->sheet->setCellValue("A3", $currentDate2);
                // $event->sheet->setCellValue("A4", $currentDate2);
                $event->sheet->getStyle('A3:A4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT
                    ]
                ]);

                $event->sheet->getStyle('A6:P7')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'ff9d96'
                        ]
                    ]
                ]);
                // End of Title

                // Set Content
                $totBangunan = count($this->bangunan);
                $beginRow = 6;
                $rangeRow = $totBangunan + $beginRow + 1;
                $rangeCell = "A{$beginRow}:P{$rangeRow}";
                $event->sheet->getStyle($rangeCell)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ],
                    ],
                    'alignment' => [
                        "wrapText" => true,
                        'vertical' => Alignment::VERTICAL_TOP
                    ]
                ]);
                // End of Set Content
            }
        ];
    }
}
