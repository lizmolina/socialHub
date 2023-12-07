<x-app-layout>
  <x-slot name="header">
      <section class="flex h-screen">
          <!-- Sidebar -->
          <div class="w-64 bg-gray-800 min-h-screen p-4 space-y-2">
              <h2 class="text-white text-lg font-bold mb-2">Menu</h2>
              <nav>
                  <ul class="text-white text-sm">
                      <li><a href="{{ route('posts') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Publication</a></li>
                      <li><a href="{{ route('schedule') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Schedules</a></li>
                      <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Schedule Recurring Post</a></li>
                      <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-700">Add Social</a></li>
                  </ul>
              </nav>
          </div>

          <!-- Main Content -->
          <div class="flex-1 p-4">
              <h1 class="text-xl font-semibold">Welcome to the Dashboard</h1>
              <!-- Más contenido aquí -->
          </div>
      </section>
  </x-slot>
</x-app-layout>
