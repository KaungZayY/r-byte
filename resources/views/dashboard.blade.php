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
                <div class="flex flex-row">
                    <input type="text" name="search" id="search" class="w-4/5 mr-1 px-4 py-2 border rounded-lg bg-white text-black dark:text-white dark:bg-black focus:outline-none focus:border-blue-500 dark:focus:border-white" placeholder="Search &#x1F50E;&#xFE0F; ..... "/>
                    <select name="" id="" class="rounded-lg bg-white text-black mr-1 dark:text-white dark:bg-black focus:outline-none focus:border-blue-500 dark:focus:border-white">
                        <option value="" selected>Order A-Z</option>
                        <option value="">Order Z-A</option>
                    </select>
                    <button class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded-lg">New Project</button>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
