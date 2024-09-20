<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project"/>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-black overflow-hidden">
                <div class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 items-center text-center mb-2">
                    <span>{{ $sprint->sprint_name }}</span>
                </div>
                <livewire:ticket-board :sprint="$sprint" :project="$project"/>
            </div>
        </div>
    </div>
</x-app-layout>
