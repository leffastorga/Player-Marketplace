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
            @if(count($card->users) > 0)
                @if(Auth::user()->id !== $card->users[0]->id)
                <p>
                    Owner: {{ $card->users[0]->name }}
                </p>
                @else
                    <p>
                        This card is yours!
                    </p>
                @endif
            @else
                <p>
                    Owner: Bank of Cards
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
        @if(count($card->schedules) == 0)
            @if(count($card->users) > 0)
                @if(Auth::user()->id !== $card->users[0]->id)
                    <a href="{{ route('buys/purchase/', $card) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Buy now!</a>
                    <a id="btnSchedule" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Scheduled purchase</a>
                    <form method="POST" action="schedules/buys}">
                        @csrf
                        @method('POST')
                    <br/>
                    <div style="display: none;" id="dvSchedule">
                        <input type="date" id="dateTransaction" name="dateTransaction" />
                        <p>All scheduled purchases are executed on the selected day at 06:00.</p>
                        <br />
                        <x-button class="ml-4">
                            {{ __('Purchase!') }}
                        </x-button>

                    </div>
                    </form>
                @endif
            @else
                <a href="{{ route('buys/purchase/', $card) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Buy now!</a>
                <a id="btnSchedule" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">Scheduled purchase</a>
                <form method="POST" action="{{ route('buys/purchase/scheduled/')}}">
                    @csrf
                    @method('POST')
                    <br/>
                    <div style="display: none;" id="dvSchedule">
                        <input type="date" id="dateTransaction" name="dateTransaction" />
                        <input type="hidden" id="card" name="card" value="{{ $card->id }}" />
                        <p>All scheduled purchases are executed on the selected day at 06:00.</p>
                        <br />
                        <x-button class="ml-4 bg-blue-800">
                            {{ __('Purchase!') }}
                        </x-button>

                    </div>
                </form>
            @endif
        @else
            <p>This card has been reserved by another user.</p>
            <strong>Soon you will be able to counter-bid in this situation.</strong>
        @endif
    </div>
</x-app-layout>
<script language="JavaScript">
    $(document).ready(function(){
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate()+1);
        $('#dateTransaction').prop('min', tomorrow.toISOString().substring(0,10));
        $('#btnSchedule').click(function(){
            $('#dvSchedule').show();
        });
    });
</script>
