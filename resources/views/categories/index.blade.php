@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Project Categories</h3>
            <p class="text-white">Manage project categories for better organization.</p>
        </div>
        <div>
            <a href="#" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + New Category
            </a>
        </div>
    </div>

    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <div class="flex flex-col">

                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700">
                    <div>
                        <h6 class="font-semibold dark:text-white">Website Development</h6>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Edit</a>
                        <a href="#" class="text-sm font-semibold text-red-500 hover:text-red-700">Delete</a>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700">
                    <div>
                        <h6 class="font-semibold dark:text-white">Brand Identity</h6>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Edit</a>
                        <a href="#" class="text-sm font-semibold text-red-500 hover:text-red-700">Delete</a>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700">
                    <div>
                        <h6 class="font-semibold dark:text-white">Social Media Management</h6>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Edit</a>
                        <a href="#" class="text-sm font-semibold text-red-500 hover:text-red-700">Delete</a>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4">
                    <div>
                        <h6 class="font-semibold dark:text-white">Video Production</h6>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Edit</a>
                        <a href="#" class="text-sm font-semibold text-red-500 hover:text-red-700">Delete</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
