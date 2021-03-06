<?php

namespace App\Exports;

use App\Models\Pengembang;
use App\Models\Perumahan;
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

    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->perumahan = Perumahan::GetAllPerumahanExport($request);
    }

    public function view(): View
    {
        $currentDate = date("d/m/Y");

        return view('exports/perumahan', [
            'data' => $this->perumahan,
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
            "A6:I6"    => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
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
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "D" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "E" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            // "G" => [
            //     'alignment' => [
            //         'horizontal' => Alignment::HORIZONTAL_LEFT
            //     ],
            // ],
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
            // "H" => [
            //     'alignment' => [
            //         'horizontal' => Alignment::HORIZONTAL_LEFT
            //     ],
            // ],
            "I" => [
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
            'C' => 35,
            'D' => 25,
            'E' => 25,
            'F' => 25,
            'G' => 25,
            'H' => 35,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set Title
                $title = "DATA PERUMAHAN DI DINAS PERUMAHAN DAN PERMUKIMAN SAMARINDA";
                $currentDate = date("d/m/Y");
                // $currentDate2 = formatTanggalIndonesia($currentDate);


                $event->sheet->mergeCells('A1:I2');
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

                $event->sheet->getStyle('A6:I6')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'ff9d96'
                        ]
                    ]
                ]);
                // End of Title

                // Set Content
                $totPerumahan = count($this->perumahan);
                $beginRow = 6;
                $rangeRow = $totPerumahan + $beginRow;
                $rangeCell = "A{$beginRow}:I{$rangeRow}";
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
