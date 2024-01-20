<x-layout>
    <x-slot name="header">
        {{ __('Location') }}
    </x-slot>
    <x-splade-data default="{ location: null}">

        <x-panel>
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold">@lang('Pick Location')</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($locations as $location)

                    <label
                        class="cursor-pointer block bg-white border-2 p-4 rounded-lg hover:shadow-lg "
                        :class="{'border-green-500': data.location == @js($location->id)}"
                    >

                        <input type="radio" value="@js($location->id)" v-model="data.location" class="sr-only"/>

                        <h2 class="text-xl font-semibold mb-2">{{$location->country }}</h2>
                        <p class="text-gray-600">City: {{$location->city }}</p>
                        <p class="text-gray-600">Location: {{$location->name }}</p>
                    </label>
                @endforeach

            </div>
        </x-panel>
        <x-splade-defer watch-value="data.location" manual url="`api/offers/${data.location}`">

            <x-panel v-if="data.location" class="">
                <div class="text-center mb-4">
                    <h1 class="text-2xl font-bold">@lang('Select Car')</h1>
                </div>

                <p v-show="processing">Loading Car Offers...</p>
                <div v-if="response.items">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                        <div v-for="(offer, index) in response.items" :key="index">

                            <div
                                class="max-w-md mx-auto bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg hover:bg-gray-100 transition duration-300 h-full flex flex-col">
                                <img class="h-48 w-full object-none " :src="offer.vehicle.imageLink"
                                     alt="Vehicle Image">

                                <div class="p-4 flex flex-grow flex-col">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-xl font-semibold" v-text="offer.vehicle.modelName"></h2>
                                        <span class="text-gray-600"
                                              v-text="offer.price.amount + ' ' + offer.price.currency"></span>
                                    </div>

                                    <div class="flex flex-grow items-center mt-2">
                                        <img class="h-8 w-8 mr-2 object-contain rounded-full"
                                             :src="offer.vendor.imageLink"
                                             alt="Vendor Logo">
                                        <span class="text-gray-500" v-text="offer.vendor.name"></span>
                                    </div>
                                    <div class="flex items-end">
                                        <x-splade-link method="POST" href="{{route('pre-reservations.store')}}"
                                                       data="{ offer: offer }"
                                                       class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            @lang('Book Now')
                                        </x-splade-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-panel>
        </x-splade-defer>

    </x-splade-data>
</x-layout>
