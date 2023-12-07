<x-app-layout>
  <x-slot name="header">
        <nav class="flex justify-center">
            <ul class="flex space-x-4">
                <li><a href="/posts/" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Publication</a></li>
                <li><a href="{{ route('schedule') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium" :class="{ 'font-semibold': request()->routeIs('schedule') }">Schedules</a></li>
                <li><a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Schedule Recurring Post</a></li>
                <li><a href="#" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Add Social</a></li>
            </ul>
        </nav>
</x-slot>
  <div class="py-12 bg-gray-100">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <x-setting heading="Add New Schedule">
                <form method="POST" action="store" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <!-- Date Input -->
                    <div>
                        <x-label name="Date" />
                        <input type="date" name="date" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    </div>

                    <!-- Time Input -->
                    <div>
                        <x-label name="Hour" />
                        <input type="time" name="time" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-opacity-50">Add</button>
                    </div>
                </form>
            </x-setting>
        </div>
    </div>
</div>
</x-app-layout>

