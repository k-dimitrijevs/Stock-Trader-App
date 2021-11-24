<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <p class="font-bold text-red-600 mb-4">Not enough money</p>
                    <a href="{{ route('viewBalance') }}"
                       class="text-gray-50 border-gray-200 pt-1 pb-1 pl-2 pr-2 rounded bg-blue-500 hover:bg-blue-700">
                        Deposit
                    </a>
                    <div class="pt-4">
                        <img src="https://i.kym-cdn.com/photos/images/facebook/001/779/895/752.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
