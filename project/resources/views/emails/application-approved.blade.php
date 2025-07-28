<x-mail::message>
<img src="{{ asset('images/demo.png') }}" alt="demo" style="width: 100%; max-width: 600px; margin-bottom: 20px; border-radius: 8px;">

# Congratulations, {{ $user->name }}!

We are delighted to inform you that your property application for **Hyslop** has been approved. Welcome to our network of esteemed property owners!

Your account has been created, and you can now access your dashboard to manage your properties.

Here are your login credentials:

<x-mail::panel>
**Email:** {{ $user->email }}<br>
**Password:** {{ $password }}
</x-mail::panel>

We strongly recommend that you change your password after logging in for the first time.

<x-mail::button :url="route('login')">
Login to Your Account
</x-mail::button>

Thank you for partnering with us. We look forward to a successful collaboration.

Best regards,<br>
The Team at {{ config('app.name') }}
</x-mail::message>
