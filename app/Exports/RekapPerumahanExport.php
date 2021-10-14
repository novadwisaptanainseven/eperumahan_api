<?php

namespace App\Exports;

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

class RekapPerumahanExport implements FromView, WithEvents, WithColumnWidths, WithStyles
{

    public function view(): View
    {
        return view('exports/rekap-perumahan', [
            'data' => Perumahan::getRekapPerumahan()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4    => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'font' => [
                    'bold' => true
                ]
            ],
            14    => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'bold' => true
                ]
            ],
            15    => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'bold' => true
                ]
            ],
            "B" => [
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
            "F" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ],
            "G" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'C' => 40,
            'D' => 19,
            'E' => 19,
            'F' => 19,
            'G' => 19,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Rekap Perumahan dan Pengembang
                // Set Title
                $title = "REKAP PERUMAHAN DAN PENGEMBANG DI KOTA SAMARINDA S/D TH 2021";

                $event->sheet->mergeCells('B2:D2');
                $event->sheet->getStyle('B2')->applyFromArray([
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
                $event->sheet->getStyle('B2')->getFont()->setBold(true)->setSize(11);
                $event->sheet->setCellValue("B2", $title);
                // End of Title

                // Content Style
                $event->sheet->getStyle('B4:D4')
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ff9d96');
                $event->sheet->getStyle('B4:D9')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);
                // End of Rekap Perumahan dan Pengembang

                // Rekap Perumahan berdasarkan Kecamatan
                // Set Title
                $title2 = "REKAP PERUMAHAN DI KOTA SAMARINDA BERDASARKAN KECAMATAN";

                $event->sheet->mergeCells('B12:G12');
                $event->sheet->getStyle('B12')->applyFromArray([
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
                $event->sheet->getStyle('B12')->getFont()->setBold(true)->setSize(11);
                $event->sheet->setCellValue("B12", $title);

                // Content Style
                $event->sheet->getStyle('B14:G15')
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('ff9d96');
                $event->sheet->getStyle('B14:G40')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);

                // End of Rekap Perumahan berdasarkan Kecamatan

            }
        ];
    }
}
