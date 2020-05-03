@component('mail::message')
# Hello {{$influencer->name}},

You account with {{config('app.name')}} has been suspended,
you will no longer be able to receive bookings from your pans and your profile will no longer appear on our site.
Please contact customer support if you believe this was a mistake.


Warm regards,<br>
{{ config('app.name') }}
@endcomponent
