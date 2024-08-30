<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 text-center leading-tight">
            {{ __('Edit Role ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('roles.edit',['project'=>$project, 'role'=>$role])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="px-16 md:px-40 lg:px-80">
                        <div class="mt-4">
                            <x-label for="role_name" value="{{ __('Role Title') }}" />
                            <x-input id="role_name" class="block mt-1 w-full" type="text" name="role_name" value="{{ $role->role_name }}" autofocus autocomplete="role_name" />
                            @error('role_name')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-text-area name="description" id="description" rows="4" class="w-full px-4 py-2" value="{{ $role->description }}"></x-text-area>
                        </div>
                        <div class="flex items-center justify-end mt-4 mb-2">
                            <x-button-cancel :cancelRoute="route('roles',$project)">
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
