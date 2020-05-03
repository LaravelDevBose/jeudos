@component('mail::message')
# Hello {{$request->name}},

Welcome to {{config('app.name')}}. Your request has been received successfully, someone will be in touch with you soon.


Warm regards,<br>
{{ config('app.name') }}
@endcomponent
