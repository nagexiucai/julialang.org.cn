@component('mail::message')
# Your account has been initialized.

Hello, your account has been initialized, please **login to reset your password**.

@component('mail::button', ['url' => '', 'color' => 'blue'])
go to reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
