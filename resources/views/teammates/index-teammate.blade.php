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
                    <form action="{{route('invites',$team)}}" method="GET">
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
                                    {{ $teammate->role->role_name?? '-' }}
                                </td>
                                <td class="px-4 py-4 max-w-xs text-sm text-gray-500 dark:text-gray-300 text-center">
                                    <div class="inline-block">
                                        <form action="{{route('roles.assign',$teammate)}}" method="GET">
                                            <button title="Edit Role">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 640 512">
                                                    <path fill="#22C55E" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    <span class="ml-2 mr-2">|</span>
                                    <div class="inline-block">
                                        <form action="{{route('teammates.delete',$teammate)}}" method="POST" onsubmit="return confirm('Move this member from team?');">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 640 512">
                                                    <path fill="#EF4444" d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM472 200l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/>
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
