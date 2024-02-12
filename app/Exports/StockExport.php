<?php

namespace App\Exports;
use App\Models\Stock;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class StockExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Product::has('stock')->with('stock')->get();
    }

    public function map($product): array
    {

        static $rowNumber = 0; // Initialize the row number counter

        $rowNumber++;
        return [
            $rowNumber,
            $product->name,
            // Format the 'price' column as a number
            $product->stock->where('type', 'out')->sum('quantity')* -1, // Customize the formatting as needed
            $product->stock->where('type', 'in')->sum('quantity')  + $product->stock->where('type', 'out')->sum('quantity') ,
            $product->price,
            $product->stock->sum('quantity') * $product->price
        ];
    }

    public function headings(): array
    {
        return [
            'S/N',
            'Name',
            'Stock Out',
            'Stock In',
            'Unit Price',
            'Total Price'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }


    // public function view(): View
    // {

    //     $products = Product::has('stock')->with('stock')->get();

    //     return view('exports.stock', [
    //         'products' => $products
    //     ]);
    // }

    public function styles(Worksheet $sheet)
    {
        return [

            'A1:'.$sheet->getHighestColumn().$sheet->getHighestRow() => [
                'borders' => [
                    'allBorders' => [
                                        'borderStyle' => Border::BORDER_THIN,
                                        'color' => [
                                            'rgb' => '000000'
                                        ]
                                    ]
                ],
            ],
        ];
    }
}
