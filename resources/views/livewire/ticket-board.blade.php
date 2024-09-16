<div>
    <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <form action="{{ route('sprints', $project) }}" method="GET">
                <button title="back" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="28" height="28" class="fill-blue-400 dark:fill-yellow-400">
                        <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/>
                    </svg>
                </button>
            </form>
            <span>{{ $sprint->sprint_name }}</span>
        </div>
        <div>
            <form action="{{route('statuses.create',['project'=>$project, 'sprint'=>$sprint])}}" method="GET">
                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 dark:bg-purple-500 hover:bg-purple-700 dark:hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24" class="mr-2 fill-current">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                    </svg>
                    Status
                </button>
            </form>
        </div>
    </div>    

    <div wire:sortable="updateStatusOrder" wire:sortable-group="updateTicketOrder" wire:sortable.options="{ animation: 50 }" class="flex flex-row text-gray-900 dark:text-gray-100 overflow-auto space-x-4 p-4">
        @foreach ($statuses as $status)
            <div 
                @if (!in_array($status->id, $pinnedStatuses))    
                    wire:sortable.item="{{ $status->id }}"
                @endif 
                wire:key="group-{{ $status->id }}" class="flex flex-col flex-shrink-0 w-96 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg p-4 h-auto border border-gray-300 dark:border-gray-700"
                >
                <div x-data="{ open: false }" x-cloak class="flex flex-row justify-between items-center mb-2 relative">
                    <button wire:click="togglePinStatus({{ $status->id }})">
                        @if (in_array($status->id, $pinnedStatuses))
                            <!-- unpinned icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="18" height="20" class="inline-block">
                                <path fill="#6b7280" d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L481.4 352c9.8-.4 18.9-5.3 24.6-13.3c6-8.3 7.7-19.1 4.4-28.8l-1-3c-13.8-41.5-42.8-74.8-79.5-94.7L418.5 64 448 64c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l29.5 0-6.1 79.5L38.8 5.1zM324.9 352L177.1 235.6c-20.9 18.9-37.2 43.3-46.5 71.3l-1 3c-3.3 9.8-1.6 20.5 4.4 28.8s15.7 13.3 26 13.3l164.9 0zM288 384l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96-64 0z"/>
                            </svg>
                        @else
                            <!-- pinned icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="18" height="20" class="inline-block">
                                <path fill="#facc15" d="M32 32C32 14.3 46.3 0 64 0L320 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-29.5 0 11.4 148.2c36.7 19.9 65.7 53.2 79.5 94.7l1 3c3.3 9.8 1.6 20.5-4.4 28.8s-15.7 13.3-26 13.3L32 352c-10.3 0-19.9-4.9-26-13.3s-7.7-19.1-4.4-28.8l1-3c13.8-41.5 42.8-74.8 79.5-94.7L93.5 64 64 64C46.3 64 32 49.7 32 32zM160 384l64 0 0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96z"/>
                            </svg>
                        @endif
                    </button>
                    @if ($editStatusId === $status->id)
                        <div class="flex flex-row">
                            <div class="flex flex-col w-2/3">
                                <x-input wire:model.defer="editValues.{{ $status->id }}"  id="status" class="block h-8" type="text" name="status" autofocus autocomplete="status" value="{{$status->status}}"/>
                                {{-- @error('status')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <button wire:click='update({{$status}})' title="Save" class="h-8 px-3 ml-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 flex items-center justify-center">
                                Save
                            </button>
                        </div>
                    @else
                        <p wire:sortable.handle class="text-lg font-bold text-gray-700 dark:text-gray-300 cursor-move select-none text-center">
                            {{ $status->status }}
                        </p>
                    @endif
                    <!-- Menu -->
                    <button x-on:click="open = ! open">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512" width="18" height="20" class="inline-block fill-black dark:fill-white">
                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                        </svg>
                    </button>
                    <div x-show="open" class="flex flex-col absolute inset-0 z-20 right-2 top-8 items-end">
                        <!-- Edit Button -->
                        <button title="Edit" wire:click='edit({{$status}})'>
                            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                                <path fill="#22C55E" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                            </svg>
                        </button>
                        <!-- Delete Button -->
                        <button title="Remove" wire:click='destroy({{$status}})' class="mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 448 512">
                                <path fill="#EF4444" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </div>
                </div>                
                <div wire:sortable-group.item-group="{{ $status->id }}" wire:sortable-group.options="{ animation: 100 }" class="flex flex-col space-y-4">
                    <!-- Tickets -->
                    @foreach ($tickets->where('status_id', $status->id) as $ticket)
                        <div wire:sortable-group.item="{{ $ticket->id }}" wire:key="task-{{ $ticket->id }}" class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-transform transform hover:scale-105 cursor-grab select-none">
                            <div wire:sortable-group.handle>
                                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $ticket->ticket_name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 max-h-4 overflow-hidden hover:max-h-none hover:overflow-auto transition-max-h duration-300">{{ $ticket->description }}</p>
                                <!-- Teammates : -->
                                <div class="mt-3">
                                    <p class="font-bold text-gray-800 dark:text-gray-200">Teammates:</p>
                                    <div class="flex space-x-2 mt-1 overflow-auto">
                                        <form action="{{route('tickets.assign',['project'=>$project,'ticket'=>$ticket])}}" method="GET">
                                            <button title="Assign">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8 h-8 fill-gray-400 dark:fill-white">
                                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        @foreach ($ticket->teammates as $teammate)
                                            <!-- Generate initials from the name -->
                                            @php
                                                $initials = collect(explode(' ', $teammate->user->name))->map(fn($name) => Str::upper($name[0]))->join('');
                                            @endphp
                                            <div x-data="{ remove: false }" x-cloak>
                                                <div x-on:mouseover = "remove = true" x-on:mouseout = "remove = false">
                                                    <div x-show="! remove" class="min-w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold text-sm">
                                                        {{ $initials }}
                                                    </div>
                                                    <button wire:click='removeAssignee({{$ticket}},{{$teammate}})' title="Remove" x-show="remove" class="min-w-8 h-8 flex items-center justify-center rounded-full bg-red-300 dark:bg-red-100 fill-red-600 text-white font-bold text-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" height="18" width="18">
                                                            <path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM472 200l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
