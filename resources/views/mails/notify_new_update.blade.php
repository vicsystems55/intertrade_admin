@component('mail::message')

{{-- <img src="" alt="well"> --}}

<h3> Hello  </h3>

<p>
   {{$data['message']}}
</p>
  
    


<p>
    Please login to check updates.
</p>
    

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
TPSA
@endcomponent