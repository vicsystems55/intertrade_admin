<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_type' => 'required|in:Invoice,Quotation,Pro forma Invoice',
            'status' => 'required|in:Draft,Unpaid,Paid',
            'vat_included' => 'required|boolean',
            'discount_type' => 'required|in:none,percentage,amount',
            'discount_value' => 'required|numeric|min:0',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',

            'customer' => 'required|array',
            'customer.company_name' => 'required|string|max:255',
            'customer.contact_person' => 'nullable|string|max:255',
            'customer.email' => 'required|email|max:255',
            'customer.address' => 'required|string|max:255',
            'customer.phone' => 'required|string|max:255',

            'lines' => 'required|array|min:1',
            'lines.*.id' => 'nullable|integer|distinct|exists:invoice_lines,id',
            'lines.*.product_id' => 'nullable|integer|exists:products,id',
            'lines.*.line_type' => 'required|in:product,service,charge',
            'lines.*.item_name' => 'required|string|max:255',
            'lines.*.description' => 'nullable|string|max:255',
            'lines.*.quantity' => 'required|numeric|gt:0',
            'lines.*.unit_price' => 'required|numeric|min:0',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->discount_type === 'percentage' && (float) $this->discount_value > 100) {
                $validator->errors()->add('discount_value', 'The percentage discount may not exceed 100.');
            }
        });
    }
}
