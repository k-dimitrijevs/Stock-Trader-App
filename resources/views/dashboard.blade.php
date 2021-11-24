<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="get" action="{{ route('search') }}">
                        @csrf
                        <label class="pr-2" for="company">Company</label>
                        <input type="text" id="company" name="company">
                        <button class="btn rounded px-4 border p-1 ml-2 text-white bg-blue-500" type="submit">Search Company</button>
                    </form>
                    @error('company')
                    <p class="font-bold text-red-600 pt-10">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
