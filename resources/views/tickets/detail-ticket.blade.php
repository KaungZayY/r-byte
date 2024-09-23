<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$ticket->project" active="sprints" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-black overflow-hidden">
                <!-- Back Button -->
                <div class="text-3xl max-w-3xl mx-auto">
                    <form action="{{ route('tickets', ['project'=>$ticket->project,'sprint'=>$ticket->sprint]) }}" method="GET">
                        <button title="back" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="28" height="28" class="fill-blue-400 dark:fill-yellow-400">
                                <path d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM215 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L392 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-214.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L103 273c-9.4-9.4-9.4-24.6 0-33.9L215 127z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <livewire:detail-ticket :ticket="$ticket"/>
            </div>
        </div>
    </div>
</x-app-layout>
