<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class InvoiceEditorTest extends TestCase
{
    use DatabaseTransactions;

    public function test_authenticated_user_can_update_invoice_lines_and_server_totals()
    {
        $user = $this->makeUser();
        $customer = $this->makeCustomer();
        $invoice = $this->makeInvoice($user, $customer);

        $keptLine = InvoiceLine::create([
            'invoice_id' => $invoice->id,
            'product_id' => null,
            'item_name' => 'Old consulting line',
            'line_type' => 'service',
            'description' => 'Old description',
            'quantity' => 1,
            'amount' => 10,
            'total_amount' => 10,
            'discount_percent' => 0,
            'discount_amount' => 0,
        ]);

        $removedLine = InvoiceLine::create([
            'invoice_id' => $invoice->id,
            'product_id' => null,
            'item_name' => 'Remove me',
            'line_type' => 'charge',
            'description' => 'Old charge',
            'quantity' => 1,
            'amount' => 5,
            'total_amount' => 5,
            'discount_percent' => 0,
            'discount_amount' => 0,
        ]);

        $response = $this->actingAs($user)->putJson(route('invoice.edit.update', $invoice), [
            'invoice_type' => 'Invoice',
            'status' => 'Unpaid',
            'vat_included' => true,
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'bank_name' => 'Test Bank',
            'account_name' => 'InterTrade Test',
            'account_number' => '0123456789',
            'customer' => [
                'company_name' => 'Updated Customer Ltd',
                'contact_person' => 'Updated Contact',
                'email' => 'updated@example.test',
                'address' => '2 Updated Street',
                'phone' => '08020000000',
            ],
            'lines' => [
                [
                    'id' => $keptLine->id,
                    'product_id' => null,
                    'line_type' => 'service',
                    'item_name' => 'Consulting',
                    'description' => 'Two consulting sessions',
                    'quantity' => 2,
                    'unit_price' => 50,
                ],
                [
                    'id' => null,
                    'product_id' => null,
                    'line_type' => 'service',
                    'item_name' => 'Installation',
                    'description' => 'On-site installation',
                    'quantity' => 1,
                    'unit_price' => 120,
                ],
            ],
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Invoice updated successfully.')
            ->assertJsonPath('summary.net_total', 198)
            ->assertJsonPath('summary.vat_amount', 14.85)
            ->assertJsonPath('summary.grand_total', 212.85);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'status' => 'Unpaid',
            'total_amount' => 198,
            'discount_percent' => 10,
        ]);
        $this->assertDatabaseHas('invoice_lines', [
            'id' => $keptLine->id,
            'item_name' => 'Consulting',
            'quantity' => 2,
            'amount' => 50,
            'total_amount' => 100,
        ]);
        $this->assertDatabaseHas('invoice_lines', [
            'invoice_id' => $invoice->id,
            'product_id' => null,
            'line_type' => 'service',
            'item_name' => 'Installation',
            'total_amount' => 120,
        ]);
        $this->assertDatabaseMissing('invoice_lines', ['id' => $removedLine->id]);
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'company_name' => 'Updated Customer Ltd',
            'business_email' => 'updated@example.test',
        ]);
    }

    public function test_invoice_cannot_update_a_line_owned_by_another_invoice()
    {
        $user = $this->makeUser();
        $customer = $this->makeCustomer();
        $invoice = $this->makeInvoice($user, $customer);
        $otherInvoice = $this->makeInvoice($user, $customer);

        $foreignLine = InvoiceLine::create([
            'invoice_id' => $otherInvoice->id,
            'product_id' => null,
            'item_name' => 'Foreign line',
            'line_type' => 'service',
            'description' => 'Foreign line',
            'quantity' => 1,
            'amount' => 50,
            'total_amount' => 50,
            'discount_percent' => 0,
            'discount_amount' => 0,
        ]);

        $response = $this->actingAs($user)->putJson(route('invoice.edit.update', $invoice), [
            'invoice_type' => 'Invoice',
            'status' => 'Draft',
            'vat_included' => false,
            'discount_type' => 'none',
            'discount_value' => 0,
            'customer' => [
                'company_name' => $customer->company_name,
                'contact_person' => $customer->contact_person_name,
                'email' => $customer->business_email,
                'address' => $customer->address,
                'phone' => $customer->business_phone1,
            ],
            'lines' => [[
                'id' => $foreignLine->id,
                'product_id' => null,
                'line_type' => 'service',
                'item_name' => 'Invalid line',
                'description' => null,
                'quantity' => 1,
                'unit_price' => 50,
            ]],
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('lines');
        $this->assertDatabaseHas('invoice_lines', [
            'id' => $foreignLine->id,
            'item_name' => 'Foreign line',
        ]);
    }

    public function test_transaction_feed_serializes_service_lines_without_a_product()
    {
        $user = $this->makeUser();
        $customer = $this->makeCustomer();
        $invoice = $this->makeInvoice($user, $customer);
        $invoice->update(['total_amount' => 75]);

        $line = InvoiceLine::create([
            'invoice_id' => $invoice->id,
            'product_id' => null,
            'item_name' => 'Ad-hoc support service',
            'line_type' => 'service',
            'description' => 'Remote support',
            'quantity' => 1.5,
            'amount' => 50,
            'total_amount' => 75,
            'discount_percent' => 0,
            'discount_amount' => 0,
        ]);

        $response = $this->getJson('/api/invoices?type=all');

        $response->assertOk()->assertJsonFragment([
            'id' => $line->id,
            'product_id' => null,
            'item_name' => 'Ad-hoc support service',
            'line_type' => 'service',
            'product' => null,
        ]);
    }

    private function makeUser()
    {
        return User::create([
            'name' => 'Invoice Test User',
            'email' => Str::uuid().'@example.test',
            'user_code' => (string) Str::uuid(),
            'password' => bcrypt('password'),
        ]);
    }

    private function makeCustomer()
    {
        return Customer::create([
            'company_name' => 'Original Customer Ltd',
            'contact_person_name' => 'Original Contact',
            'contact_person_phone' => '08010000000',
            'contact_person_address' => '1 Original Street',
            'category' => 'Business',
            'business_email' => Str::uuid().'@example.test',
            'business_phone1' => '08010000000',
            'business_phone2' => '08010000001',
            'business_phone3' => '08010000002',
            'address' => '1 Original Street',
        ]);
    }

    private function makeInvoice(User $user, Customer $customer)
    {
        return Invoice::create([
            'invoice_code' => (string) Str::uuid(),
            'generated_by' => $user->id,
            'customer_id' => $customer->id,
            'invoice_type' => 'Invoice',
            'status' => 'Draft',
            'vat_included' => false,
            'total_amount' => 0,
        ]);
    }
}
