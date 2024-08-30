<x-app-layout>
    <x-slot name="header">
        <x-project-detail-menu :project="$project" active="teams"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <p class="text-sm leading-6 font-medium text-gray-900 dark:text-white">
                    Total Teams : {{$count}}
                </p>
                <div class="flex space-x-4 items-center">
                    <form action="{{route('teams.archives',$project)}}" method="GET">
                        <button title="Archives" class="mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30" class="fill-blue-400 dark:fill-yellow-400">
                                <path d="M32 32l448 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96L0 64C0 46.3 14.3 32 32 32zm0 128l448 0 0 256c0 35.3-28.7 64-64 64L96 480c-35.3 0-64-28.7-64-64l0-256zm128 80c0 8.8 7.2 16 16 16l160 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-160 0c-8.8 0-16 7.2-16 16z"/>
                            </svg>
                        </button>
                    </form>
                    <form action="{{route('teams.create',$project)}}" method="GET">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 mr-1 bg-indigo-600 text-white font-semibold text-base leading-6 rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="24" width="24" class="mr-2 fill-current">
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                            </svg>
                            Create New Team
                        </button>                        
                    </form>
                </div>
            </div>
            <div class="flex flex-row flex-wrap">
                @foreach ($teams as $team)
                    <div x-data="{ open: false }" x-cloak class="w-full h-auto relative sm:w-1/2 md:w-1/3 lg:w-1/4 flex flex-col px-1.5 py-1.5 text-black transition duration-300 ease-in-out transform hover:scale-105">
                        <div class="rounded-lg bg-white dark:text-white dark:bg-black border border-gray-400 dark:border-gray-600 px-4 py-2">
                            <div class="flex flex-row justify-between mt-2">
                                <a href="{{route('teammates',['project' => $project, 'team' => $team])}}" class="text-xl text-indigo-600 hover:underline">{{ $team->team_name }}</a>
                                <button x-on:click="open = ! open">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="4" viewBox="0 0 128 512"><path fill="#4b5563" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                                </button>
                            </div>
                            <div x-show="open" class="flex flex-col absolute inset-0 z-20 right-6 top-14 items-end">
                                <form action="{{route('teams.edit',['project' => $project, 'team' => $team])}}" method="GET">
                                    <button title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 512 512">
                                            <path fill="#22C55E" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{route('teams.delete',['project' => $project, 'team' => $team])}}" method="POST" onsubmit="return confirm('Remove this team form the project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 448 512">
                                            <path fill="#EF4444" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <p class="text-base mt-2 h-20 overflow-hidden">{{$team->description}}</p>
                            <p class="text-sm italic text-gray-700 dark:text-gray-500 mt-1 mb-1">Created by {{$team->user->name}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
