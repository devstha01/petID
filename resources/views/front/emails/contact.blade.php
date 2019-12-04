@component('mail::message')
# Contact details

Name: {{ $contactData['name'] }}<br>
Phone: {{ $contactData['full_phone'] }}<br>
Message: {{ $contactData['message'] }}<br>

Thanks,<br>
{{ $contactData['name'] }}
@endcomponent
