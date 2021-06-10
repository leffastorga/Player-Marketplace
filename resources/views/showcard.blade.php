<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Player Info') }}
        </h2>
    </x-slot>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">

            <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                {{ $card->name }}
            </h2>
            <p class="text-base text-gray-700 md:text-lg">
                {{ $card->description }}
            </p>
            <br />
            @if(Auth::user()->id !== $card->users[0]->id)
            <p>
                Owner: {{ $card->users[0]->name }}
            </p>
            @else
                <p>
                    This card is yours!
                </p>
            @endif
        </div>
        <div class="max-w-lg space-y-3 sm:mx-auto lg:max-w-xl">
            @foreach($card->attributes as $attribute)
                @if($attribute->attribute_type !== 'image')
                    <div class="flex items-center p-2 transition-colors duration-200 border rounded shadow group">
                        <div class="mr-2">
                            <svg class="w-6 h-6 transition-colors duration-200 text-deep-purple-accent-400 sm:w-8 sm:h-8" stroke="currentColor" viewBox="0 0 52 52">
                                <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                            </svg>
                        </div>
                        <span class="text-gray-800 transition-colors duration-200">{{$attribute->attribute_type}}: {{ $attribute->attribute_value }}</span>
                    </div>
                @endif
            @endforeach
        </div>
        <br />
        @if(Auth::user()->id !== $card->users[0]->id)
            <a href="#" id="btnSchedule" class="inline-flex items-center px-4 py-2 border">Scheduled purchase</a>
            <a href="{{ route('buys/purchase/', $card) }}" class="inline-flex items-center px-4 py-2 border">Buy now!</a>
            <br/>
            <div style="display: none;" id="dvSchedule">
                <input type="date" id="dateTransaction" />
                <p>All scheduled purchases are executed on the selected day at 06:00.</p>
                <br />
                <a href="" class="inline-flex items-center px-4 py-2 border">Purchase!</a>
            </div>
        @endif
    </div>
</x-app-layout>
<script language="JavaScript">
    $(document).ready(function(){
        var now = new Date(),
            // minimum date the user can choose, in this case now and in the future
            minDate = now.toISOString().substring(0,10);
        $('#dateTransaction').prop('min', minDate);
        $('#btnSchedule').click(function(){
            $('#dvSchedule').show();
        });
    });
</script>
