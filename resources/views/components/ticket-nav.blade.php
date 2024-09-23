<!-- Sprint Info & Menu Buttons -->
<div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 flex justify-between items-center">
    <div class="flex items-center space-x-3">
        <form action="{{ route('sprints', $project) }}" method="GET">
            <button title="back" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="28" height="28"
                    class="fill-blue-400 dark:fill-yellow-400">
                    <path
                        d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z" />
                </svg>
            </button>
        </form>
        <span>{{ $sprint->sprint_name }}</span>
        </div>
        <div class="flex items-end space-x-2">
            @if (viewContent($project, 'Tickets', 'Create'))
                <form action="{{ route('tickets.direct-create', ['project' => $project, 'sprint' => $sprint]) }}"
                    method="GET">
                    <button title="Create New Ticket" type="submit"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 dark:bg-teal-500 hover:bg-teal-700 dark:hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24"
                            class="mr-2 fill-current">
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                        </svg>
                        Ticket
                    </button>
                </form>
            @endif
            @if (viewContent($project, 'Statuses', 'Create'))
                <form action="{{ route('statuses.create', ['project' => $project,'active'=>'active', 'sprint' => $sprint]) }}" method="GET">
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 dark:bg-purple-500 hover:bg-purple-700 dark:hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24"
                            class="mr-2 fill-current">
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                        </svg>
                        Status
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
<!-- -->
