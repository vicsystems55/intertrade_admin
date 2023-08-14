<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>


    <table class="table">
        <thead style="height: 90px;">
            <tr>
                <th>S/N</th>
                <th>Product</th>
                <th>Stock Out</th>
                <th>Stock In</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)

            <tr style="border: 1px solid green;">

                <td>{{$loop->iteration}}</td>

                <td>{{$product->name}}</td>

                <td>{{$product->stock->where('type', 'out')->sum('quantity')}}</td>

                <td>{{$product->stock->where('type', 'in')->sum('quantity')}}</td>

                <td>{{number_format($product->price * -1, 2) }}</td>

                <td>{{number_format($product->stock->sum('quantity') * $product->price, 2)}}</td>




            </tr>

            @endforeach

        </tbody>
    </table>

</body>
</html>
