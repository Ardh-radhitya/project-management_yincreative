@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Clients</h3>
            <p class="text-white">Manage client accounts and information.</p>
        </div>
        <div>
            <a href="#" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + Add Client
            </a>
        </div>
    </div>

    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <div class="flex flex-col">

                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700">
                    <div>
                        <h6 class="font-semibold dark:text-white">Acme Corporation</h6>
                        <p class="text-sm text-gray-500">contact@acme.com</p>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Projects</a>
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500">Edit</a>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700">
                    <div>
                        <h6 class="font-semibold dark:text-white">GlobalTech Industries</h6>
                        <p class="text-sm text-gray-500">support@globaltech.io</p>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Projects</a>
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500">Edit</a>
                    </div>
                </div>

                <div class="flex justify-between items-center p-4">
                    <div>
                        <h6 class="font-semibold dark:text-white">Nova Ventures</h6>
                        <p class="text-sm text-gray-500">hello@novaventures.dev</p>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500 mr-4">Projects</a>
                        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-blue-500">Edit</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
