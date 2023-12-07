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

  <div class="py-12">
      <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
          <x-setting heading="Edit Schedule">
              <form method="POST" action="/update/{{$schedule->id}}" enctype="multipart/form-data" class="space-y-6">
                  @csrf
                  @method('PUT')

                  <!-- Date Input -->
                  <div>
                      <x-label name="Date" />
                      <input type="date" name="date" value="{{$schedule->date}}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                  </div>

                  <!-- Time Input -->
                  <div>
                      <x-label name="Hour" />
                      <input type="time" name="time" value="{{$schedule->time}}" min="1" max="23" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                  </div>

                  <!-- Submit Button -->
                  <div>
                      <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">Edit</button>
                  </div>
              </form>
          </x-setting>
      </div>
  </div>
</x-app-layout>
