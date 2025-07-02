@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h3 class="font-bold text-white text-3xl">Welcome, Client!</h3>
    <p class="text-white mb-6">Here is the latest progress on your project.</p>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">Project: Website Redesign</h6>
                </div>
                <div class="flex-auto p-6">
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-blue-700 dark:text-white">Progress</span>
                            <span class="text-sm font-medium text-blue-700 dark:text-white">65%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <h6 class="mt-6 mb-2 capitalize dark:text-white">Recent Updates</h6>
                    <div class="p-4 mb-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">July 2, 2025:</span> UI design for the homepage has been submitted for your review.
                    </div>
                    <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-400" role="alert">
                        <span class="font-medium">June 28, 2025:</span> Project officially started.
                    </div>

                    <div class="mt-6">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Leave Feedback</button>
                        <button type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">Upload Reference File</button>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
