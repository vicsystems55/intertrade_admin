<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SupportServiceInvoiceLines extends Migration
{
    public function up()
    {
        Schema::table('invoice_lines', function (Blueprint $table) {
            if (!Schema::hasColumn('invoice_lines', 'item_name')) {
                $table->string('item_name')->nullable()->after('product_id');
            }

            if (!Schema::hasColumn('invoice_lines', 'line_type')) {
                $table->string('line_type')->default('product')->after('item_name');
            }
        });

        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE invoice_lines MODIFY product_id BIGINT UNSIGNED NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY quantity DECIMAL(15,3) NOT NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY amount DECIMAL(15,2) NOT NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY total_amount DECIMAL(15,2) NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoice_lines MODIFY discount_percent DECIMAL(8,3) NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoice_lines MODIFY discount_amount DECIMAL(15,2) NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoices MODIFY total_amount DECIMAL(15,2) NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoices MODIFY discount_percent DECIMAL(8,3) NULL');
            DB::statement('ALTER TABLE invoices MODIFY discount_amount DECIMAL(15,2) NULL');
        }

        DB::table('invoice_lines')
            ->orderBy('id')
            ->chunkById(200, function ($lines) {
                $products = DB::table('products')
                    ->whereIn('id', $lines->pluck('product_id')->filter()->unique())
                    ->get(['id', 'name', 'type'])
                    ->keyBy('id');

                foreach ($lines as $line) {
                    $product = $line->product_id ? $products->get($line->product_id) : null;

                    DB::table('invoice_lines')->where('id', $line->id)->update([
                        'item_name' => $line->item_name ?: ($product->name ?? $line->description),
                        'line_type' => $product && strtolower((string) $product->type) === 'service'
                            ? 'service'
                            : ($line->line_type ?: 'product'),
                    ]);
                }
            });
    }

    public function down()
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE invoice_lines MODIFY quantity INT NOT NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY amount INT NOT NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY total_amount INT NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoice_lines MODIFY discount_percent INT NOT NULL');
            DB::statement('ALTER TABLE invoice_lines MODIFY discount_amount INT NOT NULL');
            DB::statement('ALTER TABLE invoices MODIFY total_amount INT NOT NULL DEFAULT 0');
            DB::statement('ALTER TABLE invoices MODIFY discount_percent INT NULL');
            DB::statement('ALTER TABLE invoices MODIFY discount_amount INT NULL');
        }

        Schema::table('invoice_lines', function (Blueprint $table) {
            $table->dropColumn(['item_name', 'line_type']);
        });
    }
}
