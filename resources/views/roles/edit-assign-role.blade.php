<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="teams"/>
    </x-slot>

    <div class="py-16">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="#" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="px-16 md:px-40 lg:px-80 py-4">
                        <div class="mt-4">
                            <x-label for="role_id" value="{{ __('Update Role for ') }}' {{$user->name}} '" class="text-2xl" />
                            <select id="role_id" name="role_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ ($assignedRole && $assignedRole->id == $role->id) ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 flex justify-end">
                            <x-button-cancel :cancelRoute="route('teammates',['project' => $project, 'team' => $team])">
                                {{__('Cancel')}}
                            </x-button-cancel>
                            <x-button class="ms-2">
                                {{ __('Reassign') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
