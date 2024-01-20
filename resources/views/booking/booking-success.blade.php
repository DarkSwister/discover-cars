
<x-layout>
    <x-slot name="header">
        {{ __('Success') }}
    </x-slot>

    <x-panel class="">
        <div class="mt-8 text-2xl">
            Your booking number: {{$confirmationNumber}}
        </div>
    </x-panel>
</x-layout>
