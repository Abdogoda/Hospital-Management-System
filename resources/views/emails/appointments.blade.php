@component('mail::message')
# {{$name}}

تم حجز موعدك بتاريخ :{{$date}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent