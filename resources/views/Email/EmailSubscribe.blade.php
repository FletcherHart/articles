@component('mail::message')
# Confirm Subscription
Thank you for subscribing to our mailing list. To confirm that this was intentional, please the Confirm button below. 

If you did not do this, no further action is necessary.

@component('mail::button', ['url' => $app_url])
Confirm
@endcomponent
@endcomponent