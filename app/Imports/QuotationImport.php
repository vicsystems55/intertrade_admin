<?php
namespace App\Imports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Models\InstallationQuotation;

class QuotationImport implements ToArray, WithCalculatedFormulas
{
    public function array(array $data)
    {
        // Extract System Capacity from the Title Row
        $systemCapacity = null;
        if (!empty($data[0][0]) && str_contains($data[0][0], 'Quote for')) {
            preg_match('/(\d+(\.\d+)?)kW/', $data[0][0], $matches);
            $systemCapacity = $matches[1] ?? null;
        }

        $quotation_code = rand(1000, 99999);

        if (!$systemCapacity) {
            throw new \Exception('System capacity not found in the quote title.');
        }

        foreach ($data as $index => $row) {
            // Skip header row or any empty rows
            if ($index == 0 || $row[1] == 'ITEMS DESCRIPTION' || empty($row[1])) {
                continue;
            }

            // Ensure quantity is valid
            $quantity = is_numeric(str_replace(',', '', $row[2])) ? (int) str_replace(',', '', $row[2]) : ($row[2] ?? '1');
            if (!$quantity) continue; // Skip invalid rows

            // Insert the data
            InstallationQuotation::create([
                'quotation_code' => $quotation_code,
                'system_capacity' => $systemCapacity,
                'item_description' => $row[1],
                'quantity' => $quantity,
                'unit_price' => (float) str_replace(',', '', $row[3] ?? 0),
                'total_price' => (float) str_replace(',', '', $row[4] ?? 0),
                'total_cost' => (float) str_replace(',', '', $row[4] ?? 0),
                'category' => is_numeric($row[0]) ? 'Installation Material' : 'Main Component',
            ]);
        }
    }
}
