@component('mail::message')
# Hello,

Your payment on {{config('app.name')}} was successful, please find your request details below

@component('mail::panel')
   <strong>Amount: </strong> ${{number_format($amount/100, 2)}} <br/>
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
