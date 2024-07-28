@props(['project', 'active' => null])

<div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $project->project_name ?? 'Project Name' }}
    </h2>
    <div class="flex flex-wrap justify-start md:justify-end space-x-2">
        <form action="#" method="GET">
            <button class="{{ $active === 'teams' ? 'bg-white text-indigo-600 border-2 border-indigo-600 dark:bg-gray-800 dark:text-indigo-400 dark:border-indigo-400' : 'bg-indigo-600 dark:bg-indigo-400 text-white dark:text-gray-900' }} hover:bg-indigo-700 dark:hover:bg-indigo-500 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                Teams
            </button>
        </form>
        <form action="#" method="GET">
            <button class="{{ $active === 'backlogs' ? 'bg-white text-teal-600 border-2 border-teal-600 dark:bg-gray-800 dark:text-teal-400 dark:border-teal-400' : 'bg-teal-600 dark:bg-teal-400 text-white dark:text-gray-900' }} hover:bg-teal-700 dark:hover:bg-teal-500 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                Backlogs
            </button>
        </form>
        <form action="#" method="GET">
            <button class="{{ $active === 'sprints' ? 'bg-white text-purple-600 border-2 border-purple-600 dark:bg-gray-800 dark:text-purple-400 dark:border-purple-400' : 'bg-purple-600 dark:bg-purple-400 text-white dark:text-gray-900' }} hover:bg-purple-700 dark:hover:bg-purple-500 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                Sprints
            </button>
        </form>
        <form action="#" method="GET">
            <button class="{{ $active === 'roles' ? 'bg-white text-orange-600 border-2 border-orange-600 dark:bg-gray-800 dark:text-orange-400 dark:border-orange-400' : 'bg-orange-600 dark:bg-orange-400 text-white dark:text-gray-900' }} hover:bg-orange-700 dark:hover:bg-orange-500 font-bold py-2 px-4 sm:px-6 rounded-md shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                Roles
            </button>
        </form>
    </div>            
</div>
