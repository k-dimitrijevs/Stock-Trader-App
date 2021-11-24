<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Stocks') }}
        </h2>

        @if($income > 0)
            <h2 class="text-green-500 float-right font-semibold text-gray-800">{{ $income }}</h2>
        @else
            <h2 class="pl-2 text-red-600 float-right font-semibold text-gray-800">{{ $income }}</h2>
        @endif
        <h2 class="float-right font-semibold text-gray-800">Total income: </h2>
    </x-slot>

    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">

                    @foreach($myStocks as $myStock)
                    <div class="mb-2 p-4 bg-white border-b border-gray-200">
                        <div class="grid grid-flow-col-dense gap-5 grid-cols-8">
                            <p class="font-bold text-xl">{{ $myStock['stock_name'] }}<p>
                            <p class="text-l">{{ $myStock['stock_symbol'] }}</p>

                            <p class="text-l">{{ $myStock['stock_amount'] }}</p>
                            <p class="text-l">{{ $myStock['price'] }} USD</p>
                            <p class="text-l">{{ $myStock['total'] }} USD</p>

                            <form method="post" action="{{ route('sellStock', $myStock) }}">
                                @csrf
                                @method('PATCH')

                                <label for="amount">Amount:</label>
                                <input class="w-1/2 mr-1.5"
                                       type="number"
                                       id="amount"
                                       min="1"
                                       max="{{ $myStock['stock_amount'] }}"
                                       name="amount">
                                <button class="btn rounded border px-2 py-1 text-white bg-red-600">SELL</button>
                                @error('amount')
                                <p class="font-bold text-red-600 pt-10">{{ $message }}</p>
                                @enderror
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
