<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="roles"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-black overflow">
                <livewire:index-permission :role="$role" :project="$project"/>
            </div>
        </div>
    </div>
</x-app-layout>
