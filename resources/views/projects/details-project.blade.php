<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $project->project_name }}
            </h2>
            <div class="flex flex-wrap justify-start md:justify-end space-x-2">
                <form action="#" method="GET">
                    <button class="bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-700 dark:hover:bg-indigo-500 text-white dark:text-gray-900 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                        Teams
                    </button>
                </form>
                <form action="#" method="GET">
                    <button class="bg-teal-600 dark:bg-teal-400 hover:bg-teal-700 dark:hover:bg-teal-500 text-white dark:text-gray-900 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                        Backlogs
                    </button>
                </form>
                <form action="#" method="GET">
                    <button class="bg-purple-600 dark:bg-purple-400 hover:bg-purple-700 dark:hover:bg-purple-500 text-white dark:text-gray-900 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                        Sprints
                    </button>
                </form>
                <form action="#" method="GET">
                    <button class="bg-orange-600 dark:bg-orange-400 hover:bg-orange-700 dark:hover:bg-orange-500 text-white dark:text-gray-900 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                        Roles
                    </button>
                </form>
            </div>            
        </div>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-black overflow-hidden">
                
            </div>
        </div>
    </div>
</x-app-layout>
