<div>
    <div class="w-full text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-8 flex flex-row items-center">
        <form action="{{route('roles',$project)}}" method="GET">
            <button title="back" class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30" class="fill-blue-400 dark:fill-yellow-400">
                    <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/>
                </svg>
            </button>
        </form>
        {{ $role->role_name }}s' Permissions
    </div>

    <div class="w-full flex flex-col space-y-4">
        @foreach ($features as $feature)
            <div
                class="bg-white dark:bg-gray-900 shadow-lg rounded-xl p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between max-h-20">
                <div class="mb-4 sm:mb-0 sm:mr-8 md:w-1/2 md:flex-grow sm:w-auto flex flex-row">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        {{ $feature->feature_name }}
                    </h3>
                </div>
                <div class="flex flex-row items-center space-x-4 md:w-1/2 md:flex-grow sm:w-auto overflow-auto">
                    {{-- <div class="flex items-center space-x-2">
                        <label class="inline-flex items-center group">
                            <input type="checkbox"
                                class="form-checkbox h-5 w-5 text-blue-600 dark:text-blue-500 focus:ring-0 focus:ring-offset-0 transition-transform transform group-hover:scale-110" />
                            <span
                                class="ml-2 text-gray-800 dark:text-gray-300 font-medium group-hover:text-blue-600 dark:group-hover:text-blue-500">Select
                                All</span>
                        </label>
                        <div class="w-px h-6 bg-gray-300 dark:bg-gray-700 mx-2"></div>
                    </div> --}}
                    <div class="flex flex-row space-x-4">
                        @foreach ($feature->permissions as $index => $permission)
                            <div class="flex items-center space-x-2">
                                <label class="inline-flex items-center group">
                                    <input type="checkbox"
                                        class="form-checkbox h-5 w-5 text-green-600 dark:text-green-500 focus:ring-0 focus:ring-offset-0 transition-transform transform group-hover:scale-110"
                                        name="permissions[]" value="{{ $permission->id }}"
                                        wire:change = "toggleCheckbox({{$permission->id}})"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                    <span
                                        class="ml-2 text-gray-700 dark:text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-500">{{ $permission->permission_name }}</span>
                                </label>
                                @if (!$loop->last)
                                    <div class="w-px h-6 bg-gray-300 dark:bg-gray-700 mx-2"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
