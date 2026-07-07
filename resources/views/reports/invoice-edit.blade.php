<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>InterTrade | Edit Invoice</title>
  <link rel="stylesheet" href="{{asset('invoice')}}/assets/css/style.css">
  <style>
    .tm_edit_container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background: #f8f9fa;
      min-height: 100vh;
    }

    .tm_edit_header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 30px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .tm_edit_header h1 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
    }

    .tm_edit_actions {
      display: flex;
      gap: 12px;
    }

    .tm_btn_edit {
      padding: 12px 24px;
      border-radius: 8px;
      border: none;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }

    .tm_btn_save {
      background: #48bb78;
      color: white;
    }

    .tm_btn_save:hover {
      background: #38a169;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(72, 187, 120, 0.3);
    }

    .tm_btn_cancel {
      background: white;
      color: #667eea;
      border: 2px solid #667eea;
    }

    .tm_btn_cancel:hover {
      background: #f0f4ff;
    }

    .tm_edit_section {
      background: white;
      padding: 30px;
      border-radius: 12px;
      margin-bottom: 24px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .tm_section_title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 2px solid #e2e8f0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .tm_section_title i {
      font-size: 1.4rem;
      color: #667eea;
    }

    .tm_form_row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    .tm_form_group {
      display: flex;
      flex-direction: column;
    }

    .tm_form_group label {
      font-weight: 500;
      margin-bottom: 8px;
      color: #2d3748;
      font-size: 0.95rem;
    }

    .tm_form_group input,
    .tm_form_group select,
    .tm_form_group textarea {
      padding: 12px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    .tm_form_group input:focus,
    .tm_form_group select:focus,
    .tm_form_group textarea:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Items Table */
    .tm_items_table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .tm_items_table thead {
      background: #f7fafc;
    }

    .tm_items_table th {
      padding: 16px;
      text-align: left;
      font-weight: 600;
      color: #2d3748;
      border-bottom: 2px solid #e2e8f0;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .tm_items_table td {
      padding: 16px;
      border-bottom: 1px solid #e2e8f0;
    }

    .tm_items_table tbody tr:hover {
      background: #f7fafc;
    }

    .tm_item_input {
      width: 100%;
      padding: 10px;
      border: 1px solid #cbd5e0;
      border-radius: 6px;
      font-size: 0.9rem;
    }

    .tm_item_input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
    }

    .tm_btn_remove_item {
      background: #fc8181;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .tm_btn_remove_item:hover {
      background: #f56565;
      transform: scale(1.05);
    }

    .tm_btn_add_item {
      background: #667eea;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }

    .tm_btn_add_item:hover {
      background: #764ba2;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    /* Discount Section */
    .tm_discount_container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
      background: #f7fafc;
      border-radius: 8px;
      border: 2px dashed #cbd5e0;
      margin-bottom: 20px;
    }

    .tm_discount_option {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .tm_discount_option input[type="radio"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
      accent-color: #667eea;
    }

    .tm_discount_label {
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1;
    }

    .tm_discount_label label {
      font-weight: 600;
      color: #2d3748;
      cursor: pointer;
    }

    .tm_discount_label input {
      padding: 10px;
      border: 2px solid #e2e8f0;
      border-radius: 6px;
      font-size: 0.9rem;
    }

    .tm_discount_label input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
    }

    /* Summary Section */
    .tm_summary_box {
      background: #f7fafc;
      padding: 20px;
      border-radius: 8px;
      border-left: 4px solid #667eea;
      margin-top: 20px;
    }

    .tm_summary_row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 0.95rem;
    }

    .tm_summary_row:last-child {
      margin-bottom: 0;
      padding-top: 12px;
      border-top: 2px solid #cbd5e0;
      font-size: 1.1rem;
      font-weight: 600;
      color: #667eea;
    }

    .tm_summary_label {
      color: #4a5568;
      font-weight: 500;
    }

    .tm_summary_value {
      color: #2d3748;
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .tm_edit_header {
        flex-direction: column;
        text-align: center;
        gap: 20px;
      }

      .tm_edit_actions {
        width: 100%;
        justify-content: center;
      }

      .tm_items_table {
        font-size: 0.85rem;
      }

      .tm_items_table th,
      .tm_items_table td {
        padding: 12px 8px;
      }

      .tm_form_row {
        grid-template-columns: 1fr;
      }

      .tm_discount_container {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .tm_edit_container {
        padding: 12px;
      }

      .tm_edit_section {
        padding: 16px;
        margin-bottom: 16px;
      }

      .tm_edit_header {
        padding: 20px;
      }

      .tm_edit_header h1 {
        font-size: 1.5rem;
      }

      .tm_items_table {
        font-size: 0.8rem;
      }

      .tm_items_table th,
      .tm_items_table td {
        padding: 8px 4px;
      }
    }
  </style>
</head>

<body>
  <div class="tm_edit_container">
    <!-- Edit Header -->
    <div class="tm_edit_header">
      <div>
        <h1><i class="bx bx-edit"></i> Edit Invoice</h1>
        <p style="margin: 8px 0 0 0; opacity: 0.9;">Invoice #{{$invoice->invoice_code}}</p>
      </div>
      <div class="tm_edit_actions">
        <button class="tm_btn_edit tm_btn_cancel" onclick="history.back()">
          <i class="bx bx-arrow-back"></i> Cancel
        </button>
        <button class="tm_btn_edit tm_btn_save">
          <i class="bx bx-check"></i> Save Changes
        </button>
      </div>
    </div>

    <!-- Customer & Basic Info -->
    <div class="tm_edit_section">
      <h3 class="tm_section_title"><i class="bx bx-user"></i> Customer Information</h3>
      <div class="tm_form_row">
        <div class="tm_form_group">
          <label>Customer Name</label>
          <input type="text" value="{{$invoice->customer->company_name ?? ''}}" placeholder="Customer name">
        </div>
        <div class="tm_form_group">
          <label>Contact Person</label>
          <input type="text" value="{{$invoice->customer->conact_person_name ?? ''}}" placeholder="Contact person">
        </div>
        <div class="tm_form_group">
          <label>Email</label>
          <input type="email" value="{{$invoice->customer->business_email ?? ''}}" placeholder="Email address">
        </div>
      </div>
      <div class="tm_form_row">
        <div class="tm_form_group">
          <label>Address</label>
          <input type="text" value="{{$invoice->customer->address ?? ''}}" placeholder="Customer address">
        </div>
        <div class="tm_form_group">
          <label>Phone</label>
          <input type="tel" value="{{$invoice->customer->phone ?? ''}}" placeholder="Phone number">
        </div>
        <div class="tm_form_group">
          <label>Invoice Type</label>
          <select>
            <option value="Invoice" {{$invoice->invoice_type === 'Invoice' ? 'selected' : ''}}>Invoice</option>
            <option value="Quotation" {{$invoice->invoice_type === 'Quotation' ? 'selected' : ''}}>Quotation</option>
            <option value="Pro forma Invoice" {{$invoice->invoice_type === 'Pro forma Invoice' ? 'selected' : ''}}>Pro forma Invoice</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Invoice Items -->
    <div class="tm_edit_section">
      <h3 class="tm_section_title"><i class="bx bx-list-ul"></i> Invoice Items</h3>

      <button class="tm_btn_add_item">
        <i class="bx bx-plus-circle"></i> Add Invoice Line
      </button>

      <div style="overflow-x: auto;">
        <table class="tm_items_table">
          <thead>
            <tr>
              <th style="width: 5%;">#</th>
              <th style="width: 25%;">Product</th>
              <th style="width: 25%;">Description</th>
              <th style="width: 12%;">Price (₦)</th>
              <th style="width: 12%;">Qty</th>
              <th style="width: 15%;">Total (₦)</th>
              <th style="width: 6%;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($invoice->invoice_line as $line)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <input type="text" class="tm_item_input" value="{{$line->product->name ?? ''}}" placeholder="Product name">
              </td>
              <td>
                <input type="text" class="tm_item_input" value="{{$line->description ?? ''}}" placeholder="Description">
              </td>
              <td>
                <input type="number" class="tm_item_input" value="{{$line->amount ?? 0}}" placeholder="0.00" step="0.01">
              </td>
              <td>
                <input type="number" class="tm_item_input" value="{{$line->quantity ?? 0}}" placeholder="0">
              </td>
              <td style="font-weight: 600; color: #667eea;">
                ₦{{ number_format($line->quantity * $line->amount ?? 0, 2) }}
              </td>
              <td>
                <button class="tm_btn_remove_item">
                  <i class="bx bx-trash"></i>
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align: center; color: #a0aec0; padding: 30px;">
                <p>No invoice items. Click "Add Invoice Line" to get started.</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Discount Section -->
    <div class="tm_edit_section">
      <h3 class="tm_section_title"><i class="bx bx-tag"></i> Discount</h3>

      <div class="tm_discount_container">
        <div class="tm_discount_option">
          <input type="radio" id="discount_none" name="discount_type" value="none" checked>
          <label for="discount_none">No Discount</label>
        </div>
        <div class="tm_discount_option">
          <input type="radio" id="discount_percentage" name="discount_type" value="percentage">
          <div class="tm_discount_label">
            <label for="discount_percentage">Percentage Discount</label>
            <input type="number" id="discount_percentage_input" placeholder="Enter percentage %" min="0" max="100" step="0.01" disabled>
          </div>
        </div>
        <div class="tm_discount_option">
          <input type="radio" id="discount_amount" name="discount_type" value="amount">
          <div class="tm_discount_label">
            <label for="discount_amount">Fixed Amount Discount</label>
            <input type="number" id="discount_amount_input" placeholder="Enter amount (₦)" min="0" step="0.01" disabled>
          </div>
        </div>
      </div>
    </div>

    <!-- Charges & Summary -->
    <div class="tm_edit_section">
      <h3 class="tm_section_title"><i class="bx bx-calculator"></i> Charges & Summary</h3>

      <div class="tm_form_row">
        <div class="tm_form_group">
          <label>VAT Included?</label>
          <select>
            <option value="false" {{$invoice->vat_included === 'false' ? 'selected' : ''}}>No</option>
            <option value="true" {{$invoice->vat_included === 'true' ? 'selected' : ''}}>Yes (7.5%)</option>
          </select>
        </div>
        <div class="tm_form_group">
          <label>Payment Status</label>
          <select>
            <option value="Paid">Paid</option>
            <option value="Unpaid">Unpaid</option>
          </select>
        </div>
      </div>

      <div class="tm_summary_box">
        <div class="tm_summary_row">
          <span class="tm_summary_label">Subtotal:</span>
          <span class="tm_summary_value">₦{{ number_format($invoice->total_amount ?? 0, 2) }}</span>
        </div>
        <div class="tm_summary_row">
          <span class="tm_summary_label">Discount:</span>
          <span class="tm_summary_value">₦0.00</span>
        </div>
        <div class="tm_summary_row">
          <span class="tm_summary_label">VAT (7.5%):</span>
          <span class="tm_summary_value">₦{{ number_format(($invoice->vat_included === 'true' ? $invoice->total_amount * 0.075 : 0), 2) }}</span>
        </div>
        <div class="tm_summary_row">
          <span class="tm_summary_label">Grand Total:</span>
          <span class="tm_summary_value">₦{{ number_format(($invoice->vat_included === 'true' ? $invoice->total_amount * 1.075 : $invoice->total_amount), 2) }}</span>
        </div>
      </div>
    </div>

    <!-- Bank Details -->
    <div class="tm_edit_section">
      <h3 class="tm_section_title"><i class="bx bx-building"></i> Bank Details</h3>

      <div class="tm_form_row">
        <div class="tm_form_group">
          <label>Bank Name</label>
          <input type="text" value="{{$invoice->bank_name ?? ''}}" placeholder="Bank name">
        </div>
        <div class="tm_form_group">
          <label>Account Name</label>
          <input type="text" value="{{$invoice->account_name ?? ''}}" placeholder="Account name">
        </div>
        <div class="tm_form_group">
          <label>Account Number</label>
          <input type="text" value="{{$invoice->account_no ?? ''}}" placeholder="Account number">
        </div>
      </div>
    </div>

    <!-- Footer Actions -->
    <div style="display: flex; gap: 12px; justify-content: flex-end; margin-bottom: 30px;">
      <button class="tm_btn_edit tm_btn_cancel" onclick="history.back()">
        <i class="bx bx-x"></i> Cancel
      </button>
      <button class="tm_btn_edit tm_btn_save">
        <i class="bx bx-save"></i> Save Invoice
      </button>
    </div>
  </div>

  <script>
    // Discount radio button handlers
    const discountRadios = document.querySelectorAll('input[name="discount_type"]');
    const percentageInput = document.getElementById('discount_percentage_input');
    const amountInput = document.getElementById('discount_amount_input');

    discountRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        percentageInput.disabled = e.target.value !== 'percentage';
        amountInput.disabled = e.target.value !== 'amount';
      });
    });

    // Save button handler
    document.querySelectorAll('.tm_btn_save').forEach(btn => {
      btn.addEventListener('click', () => {
        alert('Save functionality will be implemented next!');
      });
    });
  </script>
</body>

</html>
