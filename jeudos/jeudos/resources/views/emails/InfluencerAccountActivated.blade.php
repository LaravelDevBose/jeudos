@component('mail::message')
# Hello {{$influencer->name}},

Your account has been activated, you can now start receiving bookings from your fans
@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
