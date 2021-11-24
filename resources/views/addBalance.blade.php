<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add balance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-lg">
                    <p class="font-bold">Current Balance: </p>
{{--                    <p> {{ number_format(Auth::user()->balance, 2) }} USD</p>--}}
                    <p> {{ Auth::user()->balance }} USD</p>


                    <form class="pt-10" method="post" action="{{ route('addBalance') }}">
                        @csrf
                        @method('PUT')

                        <label class="font-bold" for="addBalance">Enter Amount:</label>
                        <input class="rounded h-8" type="number" min="0" step="0.01" id="addBalance" name="addBalance">
                        <button class="btn rounded px-4 border p-0.5 ml-2 text-white bg-blue-500" type="submit">Add Balance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
