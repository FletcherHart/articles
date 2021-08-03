@component('mail::message')
# {{ $topic}}
{{ $text }}

Don't want to see these messages anymore? Click the button below to unsubscribe.
@component('mail::button', ['url' => '%mailing_list_unsubscribe_url%', 'color' => 'success'])
Unsubscribe
@endcomponent
@endcomponent