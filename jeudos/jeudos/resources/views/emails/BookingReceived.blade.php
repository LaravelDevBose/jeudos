@component('mail::message')
# Hello dear,

Your video request has been received by {{$influencer->name}}. Your request is currently being attended to.
If you feel any dissatisfaction, please kindly contact our customer support for help.

@component('mail::panel')
<strong>Fan:</strong> {{$booking->full_name}}<br/>
<strong>Occasion:</strong> {{$booking->occasion}}<br/>
<strong>Instruction:</strong> {{$booking->instruction}}<br/>
<strong>Duration:</strong> {{$booking->duration}} minutes<br/>
<strong>Social Media:</strong> {{$booking->social_media}}<br/>
<strong>Date:</strong> {{date('d,D M Y G:i A', strtotime($booking->date))}}<br/>
<strong>Amount:</strong> ${{number_format($booking->amount,2)}}<br/>
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
