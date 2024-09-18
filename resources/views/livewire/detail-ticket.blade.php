<div>
    <div class="px-16 md:px-40 lg:px-80">
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="project_id" value="{{ __('Project') }}" class="mr-4 w-1/4" />
                <x-input id="project_id" class="block w-3/4" type="text" name="project"
                    value="{{ $ticket->project->project_name }}" readonly />
            </div>
            @error('project_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="flex items-center">
                <x-label for="backlog_id" value="{{ __('Based on Backlog') }}" class="mr-4 w-1/4" />
                <x-input id="backlog_id" class="block w-3/4" type="text" name="backlog_id"
                    value="{{ $ticket->backlog->backlog }}" readonly />
            </div>
            @error('backlog_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="sprint_id" value="{{ __('From Sprint') }}" class="mr-4 w-1/4" />
                <x-input id="sprint_id" class="block w-3/4" type="text" name="sprint_id"
                    value="{{ $ticket->sprint->sprint_name }}" readonly />
            </div>
            @error('sprint_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mt-4">
            <x-label for="sprint_id" value="{{ __('Sprint') }}" />
            <select id="sprint_id" name="sprint_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($sprints as $sprint)
                    <option value="{{ $sprint->id }}" {{$sprint->id === $ticket->sprint_id ? 'selected':''}}>{{ $sprint->sprint_name }}</option>
                @endforeach
            </select>
            @error('sprint_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="ticket_name" value="{{ __('Ticket Name') }}" class="mr-4 w-1/4" />
                <x-input id="ticket_name" class="block w-3/4" type="text" name="ticket_name"
                    value="{{ $ticket->ticket_name }}" readonly />
            </div>
            @error('ticket_name')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="status_id" value="{{ __('Current Status') }}" class="mr-4 w-1/4" />
                <x-input id="status_id" class="block w-3/4" type="text" name="status_id"
                    value="{{ $ticket->status_id }}" readonly />
            </div>
            @error('status_id')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="duration" value="{{ __('Duration (in minutes)') }}" class="mr-4 w-1/4" />
                <x-input id="duration" class="block w-3/4" type="number" name="duration" autofocus
                    value="{{ $ticket->duration }}" readonly />
            </div>
            @error('duration')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="description" value="{{ __('Description') }}" class="mr-4 w-1/4" />
                <x-text-area name="description" id="description" rows="4" class="w-3/4 px-4 py-2"
                    value="{{ $ticket->description }}" readonly></x-text-area>
            </div>
            @error('description')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <div class="mt-4 flex items-center">
                <x-label for="backlog_created_by" value="{{ __('Backlog by') }}" class="mr-4 w-1/4" />
                <x-input id="backlog_created_by" class="block w-3/4" type="text"
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
                <x-input id="ticket_created_by" class="block w-3/4" type="text"
                    name="ticket_created_by" autofocus
                    value="{{ $ticket->ticket_created_by_user->name }}" readonly />
            </div>
            @error('ticket_created_by')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4 mb-2">
            <button
                class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white hover:text-black uppercase tracking-widest hover:bg-red-300 dark:hover:bg-red-400 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Delete
            </button>

            <x-button class="ms-4">
                {{ __('Edit') }}
            </x-button>
        </div>
    </div>
</div>
