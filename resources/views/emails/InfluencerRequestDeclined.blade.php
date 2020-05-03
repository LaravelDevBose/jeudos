@component('mail::message')
# Hello {{$requestInfo->name}},

We are sorry to you that your request to join {{config('app.name')}} has been declined.
Please try again later of contact our customer support if you believe this was a mistake.

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
