@foreach($customer->contacts as $contact)
    <div><span class="text-muted">{{ __($contact['type']) }}:</span> {{ $contact['value'] }}</div>
@endforeach