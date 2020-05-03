@component('mail::message')
# Hello,

A sum of money has been placed on hold in your card for you request. Please find details below

@component('mail::panel')
<strong>Amount: </strong> ${{number_format($amount)}} <br/>
<strong>Description: </strong> {{$description}}
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
