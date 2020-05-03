@component('mail::message')
# Inluencer request

A new request has been made by {{$request->name}}

@component('mail::panel')
<div style="align-items: self-start">
    <b>Name:</b> {{$request->name}}<br/>
    <b>Email:</b>   {{$request->email}}<br/>
    <b>Phone:</b>   {{$request->phone}}<br/>
    <b>Media:</b>   {{$request->media}}<br/>
    <b>Media Handle:</b>   {{$request->media_handle}}<br/>
    <b>Followers:</b>   {{number_format($request->followers)}}<br/>
</div>
@endcomponent

Manage {{$request->name}} request now

@component('mail::button', ['url' => url('/admin/influencers/requests')])
    Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
