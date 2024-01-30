
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>InterTrade | Invoice</title>
  <link rel="stylesheet" href="{{asset('invoice')}}/assets/css/style.css">
</head>

<body>
  <div class="tm_container">

    @if(Session::has('msg'))
        <p class="alert alert-info">{{ Session::get('msg') }}</p>
    @endif

    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="{{asset('assets')}}/images/logo-icon.png" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f25 tm_text_uppercase tm_white_color">PAYCHECK</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"></div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Employee ID:  <b>{{ucwords($userData->user_code)}}  </b></p>
              <p class="tm_invoice_date tm_m0">Date: <b>{{\Carbon\Carbon::now()->format('d M, Y')}}</b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Employee Details:</b></p>
              <p>
                {{ucwords($userData->name)}} <br>
                {{($userData->email)}} <br>


              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>
                InterTrade Ltd. <br>
               Plot 798, Babatope Laleye Crescent<br>Jahi, Fct. Abuja<br>
                enquiry@intertradeltd.biz
              </p>
            </div>
          </div>



          <div class="tm_table tm_style1">
            <div class="">
                <h4>Allowances</h4>
              <div style="min-height: 20px;" class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_green_bg">
                      <th class="tm_width_1 tm_semi_bold tm_white_color">S/N</th>
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Description</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Amount</th>


                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                        <td class="tm_width_1">1</td>
                        <td class="tm_width_3">{{strtoupper('BASIC SALARY')}}</td>
                        <td class="tm_width_2 tm_text_right"><b>N {{number_format($userData->salary_level->basic, 2)}}</b></td>

                      </tr>

                    @foreach ($employeePaycheckItems as $employeePaycheckItem)

                    <tr>
                      <td class="tm_width_1">{{$loop->iteration}}</td>
                      <td class="tm_width_3">{{strtoupper($employeePaycheckItem->paycheckItem->name)}}</td>
                      <td class="tm_width_2 tm_text_right"><b>N {{number_format($employeePaycheckItem->amount, 2)}}</b></td>

                    </tr>
                    @endforeach




                  </tbody>
                </table>
              </div>
            </div>

            <div class="">

                <h4>Deductions</h4>
                <div style="min-height: 20px;" class="tm_table_responsive">
                  <table>
                    <thead>
                      <tr class="tm_primary_bg bg-danger" style="background-color: red;">
                        <th class="tm_width_1 tm_semi_bold tm_white_color">S/N</th>
                        <th class="tm_width_3 tm_semi_bold tm_white_color">Description</th>
                        <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Amount</th>


                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($employeeDeductions as $employeeDeduction)

                      <tr>
                        <td class="tm_width_1">{{$loop->iteration}}</td>
                        <td class="tm_width_3">{{($employeeDeduction->deductionable->loan_application_id?'Loan Repayment': strtoupper($employeeDeduction->deductionable->name))}}</td>
                        <td class="tm_width_2 tm_text_right"><b>N {{number_format($employeeDeduction->amount, 2)}}</b></td>

                      </tr>
                      @endforeach




                    </tbody>
                  </table>
                </div>
              </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <p class="tm_m0">Bank </p>
                <p class="tm_m0">Account Name: </p>
                <p class="tm_m0">Account Number: </p>

              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                    <tr class="tm_gray_bg ">
                      <td class="tm_width_3 tm_primary_color tm_bold">GROSS:</td>
                      <td class="tm_width_3 tm_primary_color tm_bold tm_text_right"> N {{number_format($userData->salary_level->gross,2)}}</td>
                    </tr>
                    {{-- {{$invoice->vat_included}} --}}



                    <tr class="tm_gray_bg">
                      <td class="tm_width_3 tm_danger_color">DEDUCTIONS: <span class="tm_ternary_color"></span></td>
                      <td class="tm_width_3 tm_danger_color tm_text_right">N {{number_format($employeeDeductions->sum('amount'), 2)}}</td>
                    </tr>
                    <tr class="tm_accent_bg">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Take Home:	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">

                        N {{number_format($userData->salary_level->gross - $employeeDeductions->sum('amount'),2)}}
                      </td>
                    </tr>




                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_type1">
              <div class="tm_left_footer"></div>
              <div class="tm_right_footer">
                <div class="tm_sig tm_text_center">
                  {{-- <img style="width: 150px;" src="{{asset('invoice')}}/assets/img/sign.png" alt="Sign"> --}}
                  <p class="tm_m0 tm_ternary_color">...</p>
                  <p class="tm_m0 tm_f16 tm_primary_color">Management</p>
                </div>
              </div>
            </div>
          </div>










          <div class="tm_note tm_text_center tm_font_style_normal">
            <hr class="tm_mb15">
            {{-- <p class="tm_mb2"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <p class="tm_m0">All claims relating to quantity or shipping errors shall be waived by Buyer unless made in writing to <br>Seller within thirty (30) days after delivery of goods to the address stated.</p> --}}
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
                <img width="32" height="32" src="https://img.icons8.com/carbon-copy/75/new-post.png" alt="new-post"/>
            </span>
            <span class="tm_btn_text">Email Client</span>
          </a>
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
        @auth


        <form action="/mark-as-paid" method="post">
            @csrf
            <input type="hidden" name="invoice_id" value="77">
        <button type="submit" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
                <img width="32" height="32" src="https://img.icons8.com/pastel-glyph/32/card-accepted.png" alt="card-accepted"/>
            </span>
            <span class="tm_btn_text">Mark as paid.</span>
        </button>
        </form>


        @endauth
      </div>
    </div>
  </div>
  <script src="{{asset('invoice')}}/assets/js/jquery.min.js"></script>
  <script src="{{asset('invoice')}}/assets/js/jspdf.min.js"></script>
  <script src="{{asset('invoice')}}/assets/js/html2canvas.min.js"></script>
  <script src="{{asset('invoice')}}/assets/js/main.js"></script>
</body>
</html>
