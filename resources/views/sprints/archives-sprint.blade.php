<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="sprints"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <form action="{{route('sprints',$project)}}" method="GET">
                    <button title="back">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="33" height="33" class="fill-blue-400 dark:fill-yellow-400">
                            <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/>
                        </svg>
                    </button>
                </form>
                <p class="text-sm leading-6 font-medium text-gray-900 dark:text-white">
                    Total : {{ $count }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-900 shadow overflow-x-auto sm:rounded-lg">
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-300 dark:bg-gray-500 text-black dark:text-white">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium  uppercase tracking-wider">
                                Sprint
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Start Date
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                End Date
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Duration
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($sprints as $sprint)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-4 max-w-xs text-sm font-medium text-gray-900 dark:text-white text-center">
                                    {{ $sprint->sprint_name }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center break-words">
                                    {{ $sprint->description }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->status }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->sprint_start_date->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->sprint_end_date->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->duration }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    <div class="inline-block">
                                        <form action="{{ route('sprints.restore', ['project' => $project, 'id' => $sprint->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button title="Restore">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512">
                                                    <path fill="#22C55E" d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <span class="ml-2 mr-2">|</span>
                                    <div class="inline-block">
                                        <form action="{{route('sprints.force',$sprint)}}" method="POST" onsubmit="return confirm('Completely remove this Sprint?');">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 448 512">
                                                    <path fill="#EF4444" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Table Ends -->
            </div>
        </div>
    </div>
</x-app-layout>
