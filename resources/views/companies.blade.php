<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($companies as $company)
                            <div class="bg-gray-200 rounded max-w-xs w-full shadow-lg leading-normal col-md-6 p-4 text-center">
                                <p>{{ $company['description'] }}</p>
                                <p>{{ $company['displaySymbol'] }}</p>
                                <p>{{ $company['symbol'] }}</p>
                                <p>{{ $company['type'] }}</p>
                                <a
                                    href="{{ route('viewCompany', $company['symbol']) }}"
                                    class="btn rounded px-4 border p-1 ml-2 text-white bg-blue-500">
                                    View Stock
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
