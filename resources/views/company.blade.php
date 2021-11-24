<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($company['name']) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 flex content-center">
                <div class="pr-10 pt-2">
                    <img src="{{ $company['logo'] }}" alt="">
                </div>
                <div class="pl-15">
                    <p class="font-bold">Company Name:</p>
                    <p>{{ $company['name'] }}</p>

                    <p class="font-bold">Industry:</p>
                    <p>{{ $company['finnhubIndustry'] }}</p>

                    <p class="font-bold">Share Outstanding:</p>
                    <p>{{ $company['shareOutstanding'] }}</p>

                    <p class="font-bold">Market Capitalization:</p>
                    <p>{{ $company['marketCapitalization'] }}</p>

                </div>
                <div class="pl-20">
                    <p class="font-bold">Current price:</p>
                    <p>{{ $quote['c'] }} {{ $company['currency'] }}</p>

                    <p class="font-bold">Close Price:</p>
                    <p>{{ $quote['pc'] }} {{ $company['currency'] }}</p>

                    <p class="font-bold">Today high:</p>
                    <p>{{ $quote['h'] }} {{ $company['currency'] }}</p>

                    <p class="font-bold">Today low:</p>
                    <p>{{ $quote['l'] }} {{ $company['currency'] }}</p>
                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 flex content-center">
                <form class="pt-10" method="post" action=" {{ route('purchase', $company['ticker']) }}">
                    @csrf
                    @method('PUT')

                    <label class="font-bold" for="stockAmount">Enter Amount:</label>
                    <input class="rounded h-8 2xl:w-20" type="number" min="1" id="stockAmount" name="stockAmount">

                    <button class="btn rounded px-4 border p-0.5 ml-2 text-white bg-blue-500" type="submit">Purchase</button>

                    @error('stockAmount')
                    <p class="font-bold text-red-600 pt-10">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
