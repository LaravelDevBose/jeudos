@component('mail::message')
# Hello {{$user->name}},

Your password on {{config('app.name')}} has been changed successfully.
If you believe this was a mistake or was done by an intruder, contact customer support immediately.

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
