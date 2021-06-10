<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>
    <a href="{{ route('random') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Get package with random cards</a>

    <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-x-6 gap-y-12 w-full mt-6">
        <!-- Product Tile Start -->
        @foreach ($cards as $card)
        <div>
            @if(count($card->attributes) !== 0)
                @foreach ($card->attributes as $attribute)
                    @if($attribute->attribute_type == 'image')
                        <a href="#" class="block h-64 rounded-lg shadow-lg bg-white">
                            <img src="{{ $attribute->attribute_value }}" />
                        </a>
                    @endif
                @endforeach
            @else
                <a href="#" class="block h-64 rounded-lg shadow-lg bg-white"></a>
            @endif
            <div class="flex items-center justify-between mt-3">
                <div>
                    <a href="#" class="font-medium">{{ $card->name }}</a>
                    <a class="flex items-center" href="#">
                        <span class="text-xs font-medium text-gray-600">owner: </span>
                        @if(count($card->users) !== 0)
                           <span class="text-xs font-medium ml-1 text-indigo-500">{{ $card->users[0]->name }}</span>
                        @else
                            <span class="text-xs font-medium ml-1 text-indigo-500">Bank of Cards</span>
                        @endif
                    </a>
                </div>
                <span class="flex items-center h-8 bg-indigo-200 text-indigo-600 text-sm px-2 rounded">€{{ $card->price }}</span>
                <a href="{{ route('player', $card) }}" class="inline-flex items-center px-4 py-2 border">See more</a>
            </div>
        </div>
    @endforeach
        <!-- Product Tile End -->
    </div>
</x-app-layout>
