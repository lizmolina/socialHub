<x-app-layout>
  <x-slot name="header">
      <nav class="flex justify-center">
          <ul class="flex space-x-2">
              <li><a href="/post/" class="text-gray-700 hover:text-gray-900 px-2 py-1 rounded-md text-sm font-medium">Publication</a></li>
              <li><a href="{{ route('schedule') }}" class="text-gray-700 hover:text-gray-900 px-2 py-1 rounded-md text-sm font-medium" :class="{ 'font-semibold': request()->routeIs('schedule') }">Schedules</a></li>
              <li><a href="#" class="text-gray-700 hover:text-gray-900 px-2 py-1 rounded-md text-sm font-medium">Schedule Recurring Post</a></li>
              <li><a href="#" class="text-gray-700 hover:text-gray-900 px-2 py-1 rounded-md text-sm font-medium">Add Social</a></li>
          </ul>
      </nav>

</x-slot>
  <div>
      <form method="POST" action="{{ route('twitter-post') }}" enctype="multipart/form-data" class="space-y-6">
          @csrf

          <!-- Input for Image -->
          <div>
              <x-label name="Image" />
              <x-input name="image" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
          </div>

          <!-- Textarea for Description -->
          <div>
              <x-label name="Description" />
              <x-textarea name="description" required class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
          </div>

          <!-- Schedule Selector -->
          <div>
              <x-label name="Schedules" />
              <select name="schedule_id" id="schedule_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  @foreach ($calendarios as $schedule)
                      <option value="{{ $schedule->id }}">{{ $schedule->date }} - {{ $schedule->time }}</option>
                  @endforeach
              </select>

              <a href="{{ route('schedule-create') }}" class="mt-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 px-3 py-1">Register new time</a>
          </div>

          <!-- Publication Type Selector -->
          <div>
              <x-label name="Publication Type" />
              <select name="type" id="type" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  <option value="Now">Publish now</option>
                  <option value="Schedule">Publish with Schedule</option>Schedule
                  <option value="Queue">Publish with Queues</option>
              </select>
          </div>

          <!-- Submit Button -->
          <div>
              <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">Publish</button>
          </div>
      </form>
  </div>
</x-app-layout>

