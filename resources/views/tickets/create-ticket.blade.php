<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 text-center leading-tight">
            {{ __('Create Ticket to ') }}{{$project->project_name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="#" method="POST">
                    @csrf
                    <div class="px-16 md:px-40 lg:px-80">
                        <div class="mt-4">
                            <x-label for="ticket_name" value="{{ __('Ticket Name') }}" />
                            <x-input id="ticket_name" class="block mt-1 w-full" type="text" name="ticket_name" value="{{$backlog->backlog}}" readonly />
                            @error('backlog')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="sprint_id" value="{{ __('Sprint') }}" />
                            <select id="sprint_id" name="sprint_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($sprints as $sprint)
                                    <option value="{{ $sprint->id }}">{{ $sprint->sprint_name }}</option>
                                @endforeach
                            </select>
                            @error('sprint_id')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="duration" value="{{ __('Duration') }}" />
                            <div class="flex flex-row">
                                <x-input id="duration" class="block mt-1 w-1/2 mr-2" type="number" name="duration_in_hour" autofocus placeholder="Hour" />
                                <x-input id="duration" class="block mt-1 w-1/2" type="number" name="duration_in_minutes" autofocus placeholder="Minutes"/>
                            </div>
                            <div class="flex flex-row justify-end">
                                @error('duration_in_hour')
                                    <div class="text-red-500 text-sm mt-2 w-1/2">{{ $message }}</div>
                                @enderror
                                @error('duration_in_minutes')
                                    <div class="text-red-500 text-sm mt-2 w-1/2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-text-area name="description" id="description" rows="4" class="w-full px-4 py-2" value="{{$backlog->description}}"></x-text-area>
                            @error('description')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end mt-4 mb-2">
                            <x-button-cancel :cancelRoute="route('backlogs',$project)">
                                {{__('Cancel')}}
                            </x-button-cancel>
            
                            <x-button class="ms-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
