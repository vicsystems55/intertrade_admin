@extends('layouts.app')


@section('content')

<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>





    <div style="" class="page-content card" id="printable">

        <div class="p-2"></div>
        <div class="p-2"></div>
        <button class="btn btn-primary text-center " style="max-width: 340px;" onclick="printDiv('ppp')">Print Report</button>
       

        <div id="ppp">
            <h3 class="text-center">Logistics Report</h3>
        <hr class="border border-dark">

        
        <h6 class="text-center">{{$report->site_name}}</h6>
        <h6 class="text-center">{{$report->state}}</h6>

        {{-- <h4>Report</h4> --}}

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <td>
                        Report By: 
                    </td>
                    <th>
                      
                        {{$report->reporters->name}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Model: 
                    </td>
                    <th>
                        {{$report->model}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Delivery Date: 
                    </td>
                    <th>
                        {{$report->installation_completion_date}}
                    </th>
                </tr>
                <tr>
                    <td>
                        UCC Serial Number(s): 
                    </td>
                    <th>
                        {{$report->ucc_serial_number}}
                    </th>
                </tr>
                <tr>
                    <td>
                        RTM Number: 
                    </td>
                    <th>
                        {{$report->rtmd_number??'---'}}
                    </th>
                </tr>
                {{-- <tr>
                    <td>
                        Functional State: 
                    </td>
                    <th>
                        {{$report->functional_state}}
                    </th>
                </tr> --}}
                {{-- <tr>
                    <td>
                        Temperature at Update: 
                    </td>
                    <th>
                        {{$report->temp_at_update}}
                    </th>
                </tr> --}}
                <tr>
                    <td>
                        Date Submitted: 
                    </td>
                    <th>
                        {{$report->date_submitted}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Number of units: 
                    </td>
                    <th>
                        {{$report->units}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Remark: 
                    </td>
                    <th>
                        {{$report->remark}}
                    </th>
                </tr>
                <tr>
                    <td>
                        status: 
                    </td>
                    <th>
                        {{$report->status}}
                    </th>
                </tr>
                <tr>
                </tr>
            </thead>
        </table>
        <div class="">

            <div class="col-12 text-center">

                <div class="card p-1 text-center mx-auto">

                    <img class="img-fluid" style="text-align: center; height: 300px; width: 300px; object-fit: cover;" src="{{config('app.url')}}{{($report->report_images[0]->img_path)??''}}" alt="">
                    

                </div>
               
                <h6><strong>DELIVERY NOTE</strong></h6>
           

            </div>

        </div>
        </div>


            <div class="row">

                    
            @foreach ($report->report_images as $image)

                <div class="col-{{$loop->first?'12 mx-auto':'4'}} text-center">

                    <div class="card p-1 text-center mx-auto">

                        <img class="img-fluid" style="text-align: center; height: 300px; width: 300px; object-fit: cover;" src="{{config('app.url')}}{{$image->img_path}}" alt="">
                        

                    </div>
                    @if ($loop->first)
                    <h6><strong>DELIVERY NOTE</strong></h6>
                    @endif

                </div>

              
                


                
            @endforeach

            </div>





        </div>

    </div>

  
  
    <script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

    </script>


    









    
@endsection