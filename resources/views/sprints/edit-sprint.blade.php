<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="sprints"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('sprints.edit', ['project' => $project, 'sprint' => $sprint]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-16 md:px-40 lg:px-80">
                        <div class="mt-4">
                            <x-label for="sprint_name" value="{{ __('Sprint Name') }}" />
                            <x-input id="sprint_name" class="block mt-1 w-full" type="text" name="sprint_name" value="{{$sprint->sprint_name}}" autofocus autocomplete="sprint_name" />
                            @error('sprint_name')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="sprint_start_date" value="{{ __('Start Date') }}" />
                            <x-input id="sprint_start_date" class="block mt-1 w-full" type="date" name="sprint_start_date" value="{{$sprint->sprint_start_date->format('Y-m-d')}}" autocomplete="sprint_start_date" />
                            @error('sprint_start_date')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="sprint_end_date" value="{{ __('End Date') }}" />
                            <x-input id="sprint_end_date" class="block mt-1 w-full" type="date" name="sprint_end_date" value="{{$sprint->sprint_end_date->format('Y-m-d')}}" autocomplete="sprint_end_date" />
                            @error('sprint_end_date')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-text-area name="description" id="description" rows="4" class="w-full px-4 py-2" value="{{$sprint->description}}"></x-text-area>
                            @error('description')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4 mb-2">
                            <x-button-cancel :cancelRoute="route('sprints',$project)">
                                {{__('Cancel')}}
                            </x-button-cancel>
            
                            <x-button class="ms-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
