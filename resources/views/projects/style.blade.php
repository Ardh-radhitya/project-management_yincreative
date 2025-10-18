    <style>
        /* Style untuk Input Form */
        .form-input {
            @apply focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow;
        }
        /* Tombol Utama (Biru/Cyan) */
        .btn-primary {
            @apply inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-cyan hover:border-slate-700 hover:bg-slate-700 hover:text-white;
        }
        /* Tombol Sekunder (Abu-abu) */
        .btn-secondary {
            @apply inline-block px-6 py-3 mr-3 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800;
        }

        /* Style Baru untuk Tombol Aksi di Tabel */
        .btn-action-edit {
            @apply inline-block px-3 py-1 font-semibold leading-tight text-center text-white uppercase bg-slate-500 rounded-md hover:bg-slate-600 text-size-xs;
        }
        .btn-action-delete {
            @apply inline-block px-3 py-1 font-semibold leading-tight text-center text-white uppercase bg-red-500 rounded-md hover:bg-red-600 text-size-xs;
        }
        /* Style untuk Notifikasi Sukses */
        .alert-success {
            @apply relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-cyan border-slate-100;
        }
    </style>
