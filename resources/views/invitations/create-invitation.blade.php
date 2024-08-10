<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="teams"/>
    </x-slot>

    <div class="py-16">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('invites',$team)}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="px-16 md:px-40 lg:px-80 py-4">
                        <div class="mt-4">
                            <x-label for="email" value="{{ __('User Email') }}" class="uppercase text-2xl" />
                            <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="" autofocus autocomplete="email" />
                            @error('email')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 flex justify-end">
                            <x-button-cancel :cancelRoute="route('teammates',$team)">
                                {{__('Cancel')}}
                            </x-button-cancel>
                            <x-button class="ms-2">
                                {{ __('Invite') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
