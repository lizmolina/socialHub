<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-5">
                    <h5 class="text-lg text-center font-bold mb-4">Connect to Your Social Networks</h5>
                    <div >

                        <a href="{{ url('login/twitter') }}" class="block w-full text-center py-2 rounded bg-blue-500 hover:bg-blue-600 text-white font-semibold transition duration-200">Connect with Twitter</a>
                        <a href="{{ url('/post-to-linkedin') }}" class="block w-full text-center py-2 rounded bg-blue-700 hover:bg-blue-800 text-white font-semibold transition duration-200">Connect with LinkedIn</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
