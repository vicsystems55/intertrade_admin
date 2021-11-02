@extends('layouts.app')


@section('content')


    <div style="" class="page-content " id="printable">

        <button class="btn btn-primary text-center " style="max-width: 340px;" onclick="printDiv('ppp')">Print Report</button>
       

        <div style="max-width: 700px;" id="ppp" class=" mx-auto">
         <div style="min-height: 540px;" class="card">
             <div class="card-body">
            
                 <p style="font-weight: bold" class="text-center font-weight-bold">
                      <img src="{{config('app.url')}}assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                    Intertrade Ltd. <br>
                  
                     Plot 798, Jahi Fct. Abuja <br>
                     enquiry@intertradeltd.biz
                 </p>
                <p class="text-center font-weight-bold">{{$report->report_type=='installation_report'?'Insatllation':'Insatllation'}} Report</p>
               {{$report->site_name}} <br>
                {{$report->state}}</p>
                <hr class="border border-dark container">
    
            
             
    
            {{-- <h4>Report</h4> --}}
    
            <table style="" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <td style="width: 170px;" >
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
                            {{$report->report_type=='installation_report'?'Installation':'Deployment'}} Date: 
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
                    <tr>
                        <td>
                            Functional State: 
                        </td>
                        <th>
                            {{$report->functional_state}}
                        </th>
                    </tr>
                     <tr>
                        <td>
                            Temperature at Update: 
                        </td>
                        <th>
                            {{$report->temp_at_update}}
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Date Installed: 
                        </td>
                        <th>
                            {{$report->installation_completion_date}}
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
            <div class="row">

                    
                @foreach ($report->report_images->take(3) as $image)

                    <div class="col-4 text-center">

                    <div class="card p-1 text-center mx-auto ">

                        <img class="img-fluid" style="text-align: center; max-height: 300px; max-width: 300px; object-fit: cover;" src="{{config('app.url')}}{{$image->img_path}}" alt="">
                        

                    </div>
                   
                    
                
                </div>

              
                


                
                 @endforeach

            </div>
             </div>
         </div>
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