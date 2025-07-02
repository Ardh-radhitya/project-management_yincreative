@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Projects</h3>
            <p class="text-white">Here is the list of all projects.</p>
        </div>
        <div>
            <a href="#" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + New Project
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="project image">
            <div class="p-4">
                <p class="text-xs font-semibold text-gray-500">CLIENT: ACME CORPORATION</p>
                <h5 class="font-bold mb-2">Website Development</h5>

                <p class="text-sm font-semibold mb-1">Progress</p>
                <div class="w-full bg-gray-200 rounded-full mb-4">
                    <div class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 40%"> 40%</div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Due: 25 Aug 2025</span>
                </div>
            </div>
        </div>

        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="project image">
            <div class="p-4">
                <p class="text-xs font-semibold text-gray-500">CLIENT: GLOBALTECH</p>
                <h5 class="font-bold mb-2">Brand Identity</h5>

                <p class="text-sm font-semibold mb-1">Progress</p>
                <div class="w-full bg-gray-200 rounded-full mb-4">
                    <div class="bg-red-500 text-xs font-medium text-red-100 text-center p-0.5 leading-none rounded-full" style="width: 20%"> 20%</div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Due: 15 Sep 2025</span>
                </div>
            </div>
        </div>

        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/carousel-3.jpg') }}" alt="project image">
            <div class="p-4">
                <p class="text-xs font-semibold text-gray-500">CLIENT: NOVA VENTURES</p>
                <h5 class="font-bold mb-2">Marketing Campaign</h5>

                <p class="text-sm font-semibold mb-1">Progress</p>
                <div class="w-full bg-gray-200 rounded-full mb-4">
                    <div class="bg-yellow-500 text-xs font-medium text-yellow-100 text-center p-0.5 leading-none rounded-full" style="width: 85%"> 85%</div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Due: 10 Jul 2025</span>
                </div>
            </div>
        </div>

        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <img class="w-full rounded-t-2xl" src="{{ asset('assets/img/office-dark.jpg') }}" alt="project image">
            <div class="p-4">
                <p class="text-xs font-semibold text-gray-500">CLIENT: ACME CORPORATION</p>
                <h5 class="font-bold mb-2">Product Video</h5>

                <p class="text-sm font-semibold mb-1">Progress</p>
                <div class="w-full bg-gray-200 rounded-full mb-4">
                    <div class="bg-green-500 text-xs font-medium text-green-100 text-center p-0.5 leading-none rounded-full" style="width: 100%"> 100%</div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Completed</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
