@component('mail::message')
# Hello {{$requestInfo->name}},

We are happy to inform you that your request to join {{config('app.name')}} has been approved successfully. Please login and complete your profile to continue.

@component('mail::panel')
<div style="align-items: self-start">
    <b>Email:</b> {{ $requestInfo->email}}<br/>
    <b>Password:</b> {{explode('@',$requestInfo->email)[0]}}
</div>
@endcomponent

@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
