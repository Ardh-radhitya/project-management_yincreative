@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h3 class="font-bold text-white text-3xl">Welcome back, My Team!</h3>
    <p class="text-white mb-6">Here's your task and project overview for today.</p>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-8/12 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">My Active Projects</h6>
                </div>
                <div class="flex-auto p-4">
                    <div class="p-4 mb-4 border rounded-lg">
                        <h5 class="font-semibold">Website Redesign - Client GlobalTech</h5>
                        <p class="text-sm text-gray-500">Your task: Finalize homepage UI. Due: 5 July 2025.</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">In Progress</span>
                            <a href="#" class="text-sm font-bold text-blue-500 hover:underline">View Details</a>
                        </div>
                    </div>
                    <div class="p-4 border rounded-lg">
                        <h5 class="font-semibold">Social Media Campaign - Nova Ventures</h5>
                        <p class="text-sm text-gray-500">Your task: Create content for week 1. Due: Tomorrow.</p>
                        <div class="flex justify-between items-center mt-2">
                             <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-yellow-600 bg-yellow-200">Not Started</span>
                            <a href="#" class="text-sm font-bold text-blue-500 hover:underline">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-6 lg:mt-0 lg:w-4/12 lg:flex-none">
             <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">My Tasks For Today</h6>
                </div>
                <div class="flex-auto p-4">
                    <div class="flex items-center mb-2">
                        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 line-through dark:text-gray-300">Reply to client feedback</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input id="unchecked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="unchecked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Submit UI design revision</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
