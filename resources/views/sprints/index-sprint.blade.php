<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="sprints"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <p class="text-sm leading-6 font-medium text-gray-900 dark:text-white">
                    Total Sprints : {{ $count }}
                </p>
                <div class="flex space-x-4 items-center">
                    <form action="#" method="GET">
                        <button title="Archives" class="mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30" class="fill-blue-400 dark:fill-yellow-400">
                                <path d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm128 80c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/>
                            </svg>
                        </button>
                    </form>
                    <form action="{{route('sprints.create',$project)}}" method="GET">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 dark:bg-purple-500 hover:bg-purple-700 dark:hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Create New Sprint
                        </button>
                    </form>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 shadow overflow-x-auto sm:rounded-lg">
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Sprint
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Start Date
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                End Date
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Duration
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($sprints as $sprint)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                <td class="px-4 py-4 max-w-xs text-sm font-medium text-gray-900 dark:text-white text-center">
                                    @if ($sprint->status === 'inactive')
                                    <form action="{{route('sprints.start',$sprint)}}" method="POST" onsubmit="return confirm('Starting {{$sprint->sprint_name}} will stop the current active sprint if one exists. Do you wish to proceed?');">
                                        @csrf
                                        @method('PUT')
                                        <button title="Start Sprint!">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24">
                                                <path fill="#22C55E" d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9l0 176c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z"/>
                                            </svg>
                                        </button>      
                                    </form>
                                    @endif                              
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm font-medium text-gray-900 dark:text-white text-center">
                                    {{ $sprint->sprint_name }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center break-words">
                                    {{ $sprint->description }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center uppercase">
                                    @if ($sprint->status === 'inactive')
                                        <span class="text-gray-500 dark:text-gray-400 font-semibold text-center">
                                            Inactive
                                        </span>
                                    @elseif ($sprint->status === 'active')
                                        <span class="text-green-500 dark:text-green-600 font-semibold text-center">
                                            Active
                                        </span>
                                    @elseif ($sprint->status === 'completed')
                                        <span class="text-blue-500 dark:text-blue-600 font-semibold text-center">
                                            Completed
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->sprint_start_date->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->sprint_end_date->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    {{ $sprint->duration }} days
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    <div class="inline-block">
                                        <form action="{{ route('sprints.edit', ['project' => $project, 'sprint' => $sprint]) }}" method="GET">
                                            <button title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                                                    <path fill="#22C55E" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <span class="ml-2 mr-2">|</span>
                                    <div class="inline-block">
                                        <form action="#" method="POST" onsubmit="return confirm('Remove this sprint?');">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 448 512">
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
