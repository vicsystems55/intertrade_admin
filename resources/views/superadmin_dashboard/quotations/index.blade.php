@extends('layouts.app')

@section('content')

<div class="page-content ">
    <h3>Generated Quotes</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Quotation Code</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($quotations as $index => $quote)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $quote->customer->company_name }}</td>
                    <td>{{ $quote->created_at->format('d M, Y') }}</td>
                    <td>{{ $quote->quotation_code }}</td>
                    <td><a href="{{route('quotations.view', ['customer_quotation_code' => $quote->customer_quotation_code])}}" class="btn btn-primary">view</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No quotes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
