<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>
                        On this page, you can modify your credits.
                    </p>
                    <p>
                        On the next form you can see how many credits do you have now and increment or decrement them.
                    </p>
                    <br>

                    <form method="POST" action="credituser/{{ $user->credit['id'] }}">
                    @csrf
                    @method('PUT')
                        <div>
                            <x-label for="credit" :value="__('Credit (€)')" />

                            <x-input id="credit" class="block mt-1 w-full" min="0" max="999" type="number" name="credit" value="{{ $user->credit['credit'] }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                    <img width="30%" height="30%" src="https://www.seekpng.com/png/detail/272-2720577_visa-mastercard-american-express-logo-png-awesome-graphic.png" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
