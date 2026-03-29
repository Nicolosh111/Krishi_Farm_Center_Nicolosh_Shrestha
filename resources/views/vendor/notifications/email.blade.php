@component('mail::layout')

{{-- Empty header removes Laravel logo --}}
@slot('header')
@endslot

{{-- Body --}}
<div class="text-center mb-4" style="font-size: 24px; font-weight: bold;">
    Krishi Farm Center
</div>

@if(!empty($user->name))
Hello {{ $user->name }},
@else
Hello,
@endif

We received a request to reset your password for your **Krishi Farm Center** account.
Click the button below to set a new password:

@component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
{{ $actionText ?? 'Reset My Password' }}
@endcomponent

If you didn’t request this, you can safely ignore this email.
Your account remains secure.

---

Thanks for being part of our farming community!
**Krishi Farm Center Team**

{{-- Optional footer --}}
@slot('footer')
@endslot

@endcomponent
