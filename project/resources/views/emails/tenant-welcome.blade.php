<x-mail::message>
# Welcome to {{ config('app.name') }}

Hi {{ $user->name }},

Your account has been created successfully. You can now log in to our platform using the following credentials:

**Email:** {{ $user->email }}
**Password:** {{ $password }}

Please change your password after your first login for security reasons.

<x-mail::button :url="route('login')">
Login to My Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
