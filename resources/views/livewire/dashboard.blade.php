<div>
    <!-- search box and sort-->
    <div class="flex flex-row mb-8 m-1">
        <input type="text" name="search" id="search" class="w-4/5 mr-1 px-4 py-2 border rounded-lg bg-white text-black dark:text-white dark:bg-black focus:outline-none focus:border-blue-500 dark:focus:border-white" placeholder="Search &#x1F50E;&#xFE0F; ..... "/>
        <select name="" id="" class="rounded-lg bg-white text-black mr-1 dark:text-white dark:bg-black focus:outline-none focus:border-blue-500 dark:focus:border-white">
            <option value="" selected>Order A-Z</option>
            <option value="">Order Z-A</option>
        </select>
        <form action="{{route('projects.create')}}">
            <button class="bg-green-500 hover:bg-green-700 text-white px-2 py-2 rounded-lg">New Project</button>
        </form>
    </div>
    <!-- display projects -->
    <div class="flex flex-col md:flex-row">
        @foreach ($projects as $project)
            <div x-data="{ open: false }" x-cloak class="w-full h-auto relative md:w-1/2 lg:w-1/3 flex flex-col rounded-lg bg-white px-6 py-4 m-1 text-black dark:text-white dark:bg-black border border-gray-400 dark:border-gray-600">
                <div class="flex flex-row justify-between mt-2">
                    <h1 class="text-xl text-green-500">{{$project->project_name}}</h1>
                    <button x-on:click="open = ! open">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="4" viewBox="0 0 128 512"><path fill="#4b5563" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                    </button>
                </div>
                <div x-show="open" class="flex flex-col absolute inset-0 z-20 right-6 top-14 items-end">
                    <button class="bg-green-500 text-white px-2 py-1 mb-1 rounded-md w-20">Edit</button>
                    <button class="bg-red-500 text-white px-2 py-1 mb-1 rounded-md w-20">Delete</button>
                </div>
                <p class="text-base mt-2">{{$project->description}}</p>
                <p class="text-sm underline text-gray-700 dark:text-gray-500 mt-2">From: {{$project->start_date}} To: {{$project->end_date}}</p>
                <p class="text-sm italic text-gray-700 dark:text-gray-500 mt-1 mb-2">Created by {{$project->user->name}}</p>
            </div>
        @endforeach
    </div>
</div>
