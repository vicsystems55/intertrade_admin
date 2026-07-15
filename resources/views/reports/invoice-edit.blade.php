<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>InterTrade | Edit Invoice</title>
    <link rel="stylesheet" href="{{ asset('invoice/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
</head>
<body>
    <div id="app">
        <invoice-edit-component
            appurl="{{ config('app.url') }}"
            :initial-invoice='@json($invoice)'>
        </invoice-edit-component>
    </div>

    <script src="{{ asset('js/9999.js') }}"></script>
</body>
</html>
