<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Delete Project ') }}'{{$project->project_name}}'
        </h2>
    </x-slot>

    <div class="py-16">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-16 md:px-40 lg:px-80 py-4">
                        <div class="mt-4">
                            <x-label for="project_name" value="{{ __('Retype Project Name Again') }}" class="uppercase text-2xl" />
                            <x-input id="project_name" class="block mt-1 w-full" type="text" name="project_name" value="" autofocus autocomplete="project_name" />
                            @error('project_name')
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
