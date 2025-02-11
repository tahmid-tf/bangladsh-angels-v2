<x-mail::message>



{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Action Button --}}
@isset($actionText)
<x-mail::button :url="$actionUrl" color="success">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Footer --}}
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-top: 30px; padding: 20px; text-align: center; background-color: #f9f9f9; border-radius: 5px;">
    <tr>
        <td align="center" style="color: #333; font-size: 12px;">
            © {{ date('Y') }} Bangladesh Angels, <a href="https://www.linkedin.com/company/bangladesh-angels/" style="color: #16a34a; text-decoration: none;">LinkedIn</a> | <a href="https://bdangels.co" style="color: #16a34a; text-decoration: none;">Our Website</a><br>
            Telephone: +8801823998877 | <a href="mailto:hello@bdangels.co" style="color: #16a34a; text-decoration: none;">hello@bdangels.co</a>
        </td>
    </tr>
</table>

</x-mail::message>
