<x-app-layout>
    <x-slot name="header">

            <nav class="flex justify-center space-x-4">
                @foreach(['Publication' => '/posts/', 'Schedules' => route('schedule'), 'Schedule Recurring Post' => '#', 'Add Social' => '#'] as $label => $link)
                    <a href="{{ $link }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:text-white focus:bg-gray-700">{{ $label }}</a>
                @endforeach
            </nav>

    </x-slot>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <x-setting heading="Schedule Administration">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">Day</th>
                            <th scope="col" class="py-3 px-6">Hour</th>
                            <th scope="col" class="py-3 px-6 text-center">Edit</th>
                            <th scope="col" class="py-3 px-6 text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calendarios as $schedule)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- Day and Hour -->
                                <td class="py-4 px-6">{{ $schedule->date }}</td>
                                <td class="py-4 px-6">{{ $schedule->time }}</td>

                                <!-- Edit Button -->
                                <td class="py-4 px-6 text-center">
                                    <a href="schedule/{{ $schedule->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>

                                <!-- Delete Button -->
                                <td class="py-4 px-6 text-center">
                                    <form method="POST" action="/delete/{{ $schedule->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <a href="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Schedule</a>
            </div>
        </x-setting>
    </div>
</x-app-layout>
