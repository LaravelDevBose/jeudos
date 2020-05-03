@component('mail::message')
# Hello {{$influencer->name}},

A new video has been sent to you, please find details below
@component('mail::panel')
<strong>Fan:</strong> {{$booking->full_name}}<br/>
<strong>Occasion:</strong> {{$booking->occasion}}<br/>
<strong>Instruction:</strong> {{$booking->instruction}}<br/>
<strong>Duration:</strong> {{$booking->duration}} minutes<br/>
<strong>Social Media:</strong> {{$booking->social_media}}<br/>
<strong>Date:</strong> {{date('d,D M Y G:i A', strtotime($booking->date))}}<br/>
<strong>Amount:</strong> {{number_format($booking->amount,2)}}<br/>
@endcomponent

Click on the button below to fulfill request
@component('mail::button', ['url' => url('influencer/bookings/view/'.encrypt($booking->id))])
Manage Booking
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
