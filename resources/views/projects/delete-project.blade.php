<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Delete Project ') }}'{{$project->project_name}}'
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('projects.delete',$project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="px-16 md:px-40 lg:px-80 py-4">
                        <div class="mt-4">
                            <x-label for="project_name" value="{{ __('Retype Project Name Again') }}" class="uppercase text-2xl" />
                            <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" value="" :value="old('project_name')" autofocus />
                            @error('project_name')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="confirm_delete" class="flex items-center">
                                <input id="confirm_delete" type="checkbox" name="confirm_delete" class="mr-2">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ __('Delete Project? Action cannot be undone') }}</span>
                            </label>
                            @error('confirm_delete')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4 mb-4">
                            <button class="w-full items-center px-4 py-3 bg-red-500 dark:bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 dark:hover:bg-red-400 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                DELETE PROJECT
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
