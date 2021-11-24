<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                        <div class="mb-2 p-6 bg-white border-b border-gray-200">
                            <div class="grid grid-cols-5 sm:grid-cols-5 md:grid-cols-5 lg:grid-cols-5 gap-1">
                                TRANSACTIONS
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
