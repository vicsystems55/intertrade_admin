<?php

namespace App\Exports;

use App\Models\InvoiceLine;
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


class SalesExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return InvoiceLine::has('product')->with('product')->with('invoice.customer')->get();
    }

    public function map($product): array
    {

        static $rowNumber = 0; // Initialize the row number counter

        $rowNumber++;
        return [
            $rowNumber,
            $product->invoice?
            $product->invoice->customer?$product->invoice->customer->company_name:''
            :'no',
            $product->product->name,
            $product->description,
            // Format the 'price' column as a number
            $product->quantity, // Customize the formatting as needed
            $product->amount,
            $product->total_amount,
            $product->created_at

        ];
    }

    public function headings(): array
    {
        return [
            'S/N',
            'Customer',
            'Product Name',
            'Description',
            'Qty',
            'Unit Price',
            'Total Price',
            'Date'
        ];
    }

    public function columnFormats(): array
    {
        return [

            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,

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
