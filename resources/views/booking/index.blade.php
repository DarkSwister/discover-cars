
<x-layout>
    <x-slot name="header">
        {{ __('Your Bookings') }}
    </x-slot>

    <x-panel>
            <x-splade-table :for="$bookings" />
    </x-panel>
</x-layout>
