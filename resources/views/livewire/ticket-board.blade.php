<div>
    <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 inline-flex">
        <form action="{{route('sprints',$project)}}" method="GET">
            <button title="back" class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="28" height="28" class="fill-blue-400 dark:fill-yellow-400">
                    <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/>
                </svg>
            </button>
        </form>
        {{ $sprint->sprint_name }}
    </div>

    <div wire:sortable="updateStatusOrder" wire:sortable-group="updateTicketOrder" wire:sortable.options="{ animation: 50 }" class="flex flex-row text-gray-900 dark:text-gray-100 overflow-auto space-x-4 p-4">
        @foreach ($statuses as $status)
            <div wire:sortable.item="{{ $status->id }}" wire:key="group-{{ $status->id }}" class="flex flex-col w-1/3 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg p-4 h-auto">
                <p wire:sortable.handle class="text-lg font-bold text-center mb-4 text-gray-700 dark:text-gray-300 cursor-move select-none">{{ $status->status }}</p>
                <div wire:sortable-group.item-group="{{ $status->id }}" wire:sortable-group.options="{ animation: 100 }" class="flex flex-col space-y-4">
                    @foreach ($tickets->where('status_id', $status->id) as $ticket)
                        <div wire:sortable-group.item="{{ $ticket->id }}" wire:key="task-{{ $ticket->id }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-transform transform hover:scale-105 cursor-grab select-none">
                            <div wire:sortable-group.handle>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $ticket->ticket_name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 max-h-4 overflow-hidden hover:max-h-none hover:overflow-auto transition-max-h duration-300">{{ $ticket->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
