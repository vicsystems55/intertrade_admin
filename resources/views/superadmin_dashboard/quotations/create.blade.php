@extends('layouts.app')

@section('content')

<div class="page-content container mt-4">
    <h1>Installation Quotations</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Quotation Code</th>
                <th>System Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation_templates as $quotation)
                <tr>
                    <td>{{ $quotation->quotation_code }}</td>
                    <td>{{ $quotation->system_capacity }}</td>
                    <td>
                        <a href="{{ route('quotations.generate', ['quotation_code' => $quotation->quotation_code]) }}" class="btn btn-primary">
                            Create New
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
