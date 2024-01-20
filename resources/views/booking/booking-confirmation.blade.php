<x-layout>
    <x-slot name="header">
        <x-splade-link href="{{ route('locations') }}" class="mr-2">
            Back
        </x-splade-link>
        {{ __('Reservation') }}
    </x-slot>
    <x-panel class=" pt-8 pb-8">
        <div class="border-b text-2xl">

            <img class="h-48 w-full object-none" src="{{$offer->vehicle->imageLink}}" alt="Vehicle Image">

            <div class="p-4 flex flex-col flex-grow">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">{{$offer->vehicle->modelName}}</h2>
                    <span class="text-gray-600">{{$offer->price->amount}} {{$offer->price->currency}}</span>
                </div>

                <div class="flex flex-grow items-center mt-2">
                    <img class="h-8 w-8 mr-2 object-contain rounded-full" src="{{$offer->vendor->imageLink}}"
                         alt="Vendor Logo">
                    <span class="text-gray-500">{{$offer->vendor->name}}</span>
                </div>
            </div>


        </div>
        <x-splade-form action="/reservation" :default="['offerUId' => $offer->offerUId]">
            <x-splade-input type="hidden" name="offerUId"/>
            <x-splade-input name="name" label="Name" required/>
            <x-splade-input name="surname" label="Surname" required/>
            <x-splade-submit
                class="mt-2 w-full rounded-md bg-black py-1.5 font-medium text-blue-50 hover:bg-blue-600"
                label="Reserve"/>
        </x-splade-form>
    </x-panel>
</x-layout>
