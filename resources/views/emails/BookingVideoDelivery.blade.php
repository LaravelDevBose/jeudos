@component('mail::message')
# Hello {{$booking->from}}

Your video request with details below has been fulfilled
@component('mail::panel')
    <strong>Fan:</strong> {{$booking->full_name}}<br/>
    <strong>Occasion:</strong> {{$booking->occasion}}<br/>
    <strong>Instruction:</strong> {{$booking->instruction}}<br/>
    <strong>Booking Date:</strong> {{date('d, D M Y',strtotime($booking->created_at))}}
@endcomponent

click on the button below to view your video.

@component('mail::button', ['url' => url('video/'.encrypt($booking->id))])
View Video
@endcomponent

Warm regards,<br>
{{ config('app.name') }}
@endcomponent
