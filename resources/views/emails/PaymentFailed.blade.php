@component('mail::message')
# Hello dear,

Your payment on {{config('app.name')}} was not successful

@component('mail::panel')
{{$error->code}} - {{$error->message}}
@endcomponent


Warm regards,<br>
{{ config('app.name') }}
@endcomponent
