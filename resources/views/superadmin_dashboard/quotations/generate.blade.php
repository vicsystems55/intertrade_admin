@extends('layouts.app')

@section('content')

<div class="page-content ">
    <h3>Quotation Details</h3>

    <form action="{{ route('quotations.update') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="quotation_code" value="{{$quotation_code}}">
        <input type="hidden" name="system_capacity" value="{{$system_capacity}}">


        <!-- Customer Information Fields -->
        <div class="card mb-4 p-3">
            <h4>Customer Information</h4>
            <div class="row">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="customer_email" class="form-label">Email</label>
                    <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="customer_phone" class="form-label">Phone</label>
                    <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="customer_address" class="form-label">Address</label>
                    <input type="text" name="customer_address" class="form-control" value="{{ old('customer_address') }}" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="customer_company_name" class="form-label">Company Name</label>
                    <input type="text" name="customer_company_name" class="form-control" value="{{ old('customer_company_name') }}" required>
                </div>

            </div>
        </div>

        <!-- Quotation Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Unit Price (NGN)</th>
                    <th>Total Price (NGN)</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($template as $quotation)
                    <tr>
                        <input type="hidden" name="quotations[{{ $quotation->id }}][id]" value="{{ $quotation->id }}">

                        <!-- Item Description -->
                        <td>
                            @if ($quotation->category == 'Main Component')
                            {{ $quotation->item_description }}
                            <input type="hidden" name="quotations[{{ $quotation->id }}][description]"
                            class="form-control description" value="{{ $quotation->item_description }}"
                            data-id="{{ $quotation->id }}" >
                            @else
                                <input type="text" name="quotations[{{ $quotation->id }}][description]"
                                       class="form-control description" value="{{ $quotation->item_description }}"
                                       data-id="{{ $quotation->id }}">
                            @endif
                        </td>

                        <!-- Quantity -->
                        <td>
                            @if ($quotation->category == 'Main Component')
                                <!-- Empty cell for main component -->
                            @else
                                <input type="number" name="quotations[{{ $quotation->id }}][quantity]"
                                       class="form-control quantity" value="{{ $quotation->quantity }}" min="1"
                                       onchange="updateTotal(this)" data-id="{{ $quotation->id }}">
                            @endif
                        </td>

                        <!-- Unit Price -->
                        <td>
                            @if ($quotation->category == 'Main Component')
                                <!-- Empty cell for main component -->
                                <input type="hidden" name="quotations[{{ $quotation->id }}][unit_price]"
                                class="form-control unit_price" value="{{ $quotation->total_price }}" step="50.00" min="0"
                                onchange="updateTotal(this)" data-id="{{ $quotation->id }}">
                            @else
                                <input type="number" name="quotations[{{ $quotation->id }}][unit_price]"
                                       class="form-control unit_price" value="{{ $quotation->unit_price }}" step="50.00" min="0"
                                       onchange="updateTotal(this)" data-id="{{ $quotation->id }}">
                            @endif
                        </td>

                        <!-- Total Price (With Formatting) -->
                        <td>
                            <input type="text" class="form-control total_price"
                                   value="{{ number_format($quotation->total_price, 2) }}" readonly
                                   data-id="{{ $quotation->id }}">
                        </td>

                        <!-- Category -->
                        <td>{{ $quotation->category }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="{{ route('quotations.fetch') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- JavaScript to auto-update total price with formatting -->
<script>
    function updateTotal(input) {
        let row = input.closest('tr');
        let quantity = row.querySelector('.quantity') ? parseFloat(row.querySelector('.quantity').value) || 1 : 1;
        let unitPrice = row.querySelector('.unit_price') ? parseFloat(row.querySelector('.unit_price').value) || 0 : 0;
        let totalPriceField = row.querySelector('.total_price');
        let description = row.querySelector('.description');


        let total = (quantity * unitPrice).toFixed(2);
        totalPriceField.value = formatNumber(total);
    }

    function formatNumber(number) {
        return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(number);
    }
</script>

@endsection
