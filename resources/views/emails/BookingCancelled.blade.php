@component('mail::message')
# Hello {{$booking->full_name}},

{{$influencer->name}} cancelled your booking, your money will be refunded to your account shortly.
Below were your booking details.

@component('mail::panel')
    <strong>Duration:</strong> {{$booking->duration}}<br/>
    <strong>Social Media:</strong> {{$booking->social_media}}<br/>
    <strong>Date:</strong> {{date('d,D M Y G:i A', strtotime($booking->date))}}<br/>
    <strong>Amount:</strong> {{number_format($booking->amount,2)}}<br/>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
