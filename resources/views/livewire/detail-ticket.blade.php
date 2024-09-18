<div>
    <div x-data="{ edit: false }" x-cloak class="px-16 md:px-40 lg:px-80">
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="project_id" value="{{ __('Project') }}" class="mr-4 w-1/4" />
                <x-input id="project_id" class="block w-3/4 bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500" type="text" name="project"
                    value="{{ $ticket->project->project_name }}" readonly />
            </div>
            @error('project_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="flex items-center">
                <x-label for="backlog_id" value="{{ __('Based on Backlog') }}" class="mr-4 w-1/4" />
                <x-input id="backlog_id" class="block w-3/4 bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500" type="text" name="backlog_id"
                    value="{{ $ticket->backlog->backlog }}" readonly />
            </div>
            @error('backlog_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="sprint_id" value="{{ __('From Sprint') }}" class="mr-4 w-1/4" />
                <select x-bind:disabled="! edit" id="sprint_id" name="sprint_id" class="block w-3/4 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach ($sprints as $sprint)
                        <option value="{{ $sprint->id }}" {{$sprint->id === $ticket->sprint_id ? 'selected':''}}>{{ $sprint->sprint_name }}</option>
                    @endforeach
                </select>
            </div>
            @error('sprint_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="ticket_name" value="{{ __('Ticket Name') }}" class="mr-4 w-1/4" />
                <x-input id="ticket_name" class="block w-3/4" type="text" name="ticket_name"
                    value="{{ $ticket->ticket_name }}" x-bind:readonly="! edit" x-bind:class="!edit && 'bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500'" />
            </div>
            @error('ticket_name')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="status_id" value="{{ __('Current Status') }}" class="mr-4 w-1/4" />
                <x-input id="status_id" class="block w-3/4 bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500" type="text" name="status_id"
                    value="{{ $ticket->status->status }}" readonly />
            </div>
            @error('status_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="duration" value="{{ __('Duration (in minutes)') }}" class="mr-4 w-1/4" />
                <x-input id="duration" class="block w-3/4" type="number" name="duration" autofocus
                    value="{{ $ticket->duration }}" x-bind:readonly="! edit" x-bind:class="!edit && 'bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500'" />
            </div>
            @error('duration')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="description" value="{{ __('Description') }}" class="mr-4 w-1/4" />
                <x-text-area name="description" id="description" rows="4" class="w-3/4 px-4 py-2"
                    value="{{ $ticket->description }}" x-bind:readonly="! edit" x-bind:class="!edit && 'bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500'"></x-text-area>
            </div>
            @error('description')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="backlog_created_by" value="{{ __('Backlog by') }}" class="mr-4 w-1/4" />
                <x-input id="backlog_created_by" class="block w-3/4 bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500" type="text"
                    name="backlog_created_by" autofocus
                    value="{{ $ticket->backlog_created_by_user->name }}" readonly />
            </div>
            @error('backlog_created_by')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="ticket_created_by" value="{{ __('Ticket by') }}" class="mr-4 w-1/4" />
                <x-input id="ticket_created_by" class="block w-3/4 bg-gray-50 text-gray-500 dark:bg-gray-500 dark:text-gray-500" type="text"
                    name="ticket_created_by" autofocus
                    value="{{ $ticket->ticket_created_by_user->name }}" readonly />
            </div>
            @error('ticket_created_by')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4 mb-2">
            <button
                type="button" wire:click='destroy({{$ticket}})' wire:confirm="Are you sure you want to delete this ticket?"
                class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white hover:text-black uppercase tracking-widest hover:bg-red-300 dark:hover:bg-red-400 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Delete
            </button>

            <button x-on:click="edit = true" x-show="! edit"
                class="inline-flex items-center px-4 py-2 bg-green-500 dark:bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white hover:text-black dark:text-gray-800 uppercase tracking-widest hover:bg-green-300 dark:hover:bg-green-400 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                Edit
            </button>

            <x-button x-show="edit" class="ms-4">
                {{ __('Update') }}
            </x-button>
        </div>
    </div>
</div>
