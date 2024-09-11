<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="sprints"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow">
                <livewire:ticket-board :sprint="$sprint" :project="$project"/>
            </div>
        </div>
    </div>
</x-app-layout>
