<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$ticket->project" active="sprints" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-black overflow-hidden">
                <livewire:detail-ticket :ticket="$ticket"/>
            </div>
        </div>
    </div>
</x-app-layout>
