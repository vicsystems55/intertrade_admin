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
                <th>LGA</th>
                <th>LOCATION</th>
                <th>DELIVERY STATUS</th>
                <th>INSTALLATION STATUS</th>
                <th>COMPLETION</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($reports as $report)

            <tr>

                <td>{{$loop->iteration}}</td>

                <td>{{$report->lga}}</td>

                <td>{{$report->location}}</td>

                <td>{{$report->delivery_status}}</td>

                <td>{{$report->installation_status}}</td>




            </tr>

            @endforeach

        </tbody>
    </table>

</body>
</html>
