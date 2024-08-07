<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="teams"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <p class="text-sm leading-6 font-medium text-gray-900 dark:text-white">
                    Members: {{$count}}
                </p>
                <a href="{{ route('teams', $project) }}" class="text-xl leading-6 font-medium text-gray-900 dark:text-white hover:text-blue-500">
                    {{ $team->team_name }}
                </a>
                <div class="flex space-x-4 items-center">
                    <form action="#" method="GET">
                        <button type="submit" class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 dark:bg-orange-400 hover:bg-orange-700 dark:hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24" class="mr-2 fill-current">
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                            </svg>
                            Role
                        </button>
                    </form>
                    <form action="#" method="GET">
                        <button type="submit" class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24" class="mr-2 fill-current">
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                            </svg>
                            Invite
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
                                No
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                User Name
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($teammates as $teammate)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                <td class="px-4 py-4 max-w-xs text-sm font-medium text-gray-900 dark:text-white text-center">
                                    {{ $loop->iteration }}                        
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm font-medium text-gray-900 dark:text-white text-center">
                                    {{ $teammate->user->name?? '<deleted data>' }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center break-words">
                                    {{ $teammate->role->role_name?? '<deleted data>' }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    <div class="inline-block">
                                        <form action="#" method="POST" onsubmit="return confirm('Move this member from team?');">
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
