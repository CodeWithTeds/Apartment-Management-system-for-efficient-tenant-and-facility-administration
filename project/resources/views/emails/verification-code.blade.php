<x-mail::message>
# Your Verification Code

Here is your verification code:

<x-mail::panel>
{{ $code }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
