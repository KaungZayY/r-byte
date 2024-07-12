<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('projects.edit',$project)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-16 md:px-40 lg:px-80">
                        <div class="mt-4">
                            <x-label for="project_name" value="{{ __('Project Name') }}" />
                            <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" value="{{$project->project_name}}" autofocus autocomplete="project_name" />
                            @error('project_name')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="start_date" value="{{ __('Start Date') }}" />
                            <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" value="{{$project->start_date}}" autocomplete="start_date" />
                            @error('start_date')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="end_date" value="{{ __('End Date') }}" />
                            <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{$project->end_date}}" required autocomplete="end_dates" />
                            @error('end_date')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-text-area name="description" id="description" rows="4" class="w-full px-4 py-2" value="{{$project->description}}"></x-text-area>
                        </div>

                        <div class="flex items-center justify-end mt-4 mb-2">
                            <x-button-cancel :cancelRoute="route('dashboard')">
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
