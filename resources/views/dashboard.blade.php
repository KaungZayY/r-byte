<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
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
                    <!-- foreach -->
                    <div x-data="{ open: false }" x-cloak class="w-full h-auto relative md:w-1/2 lg:w-1/3 flex flex-col rounded-lg bg-white px-6 py-4 m-1 text-black dark:text-white dark:bg-black border border-gray-400 dark:border-gray-600">
                        <div class="flex flex-row justify-between mt-2">
                            <h1 class="text-xl text-green-500">Example Project</h1>
                            <button x-on:click="open = ! open">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="4" viewBox="0 0 128 512"><path fill="#4b5563" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                            </button>
                        </div>
                        <div x-show="open" class="flex flex-col absolute inset-0 z-20 right-6 top-14 items-end">
                            <button class="bg-green-500 text-white px-2 py-1 mb-1 rounded-md w-20">Edit</button>
                            <button class="bg-red-500 text-white px-2 py-1 mb-1 rounded-md w-20">Delete</button>
                        </div>
                        <p class="text-base mt-2">This is an brief description of the project, nothing serious. A description may be this long or in some case shorter or longer.</p>
                        <p class="text-sm underline text-gray-700 dark:text-gray-500 mt-2">From: 24 July 2024 To: 24 September 2024</p>
                        <p class="text-sm text-gray-700 dark:text-gray-500 mt-1 mb-2">Created by Franky</p>
                    </div>
                    <!-- endforeach -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
