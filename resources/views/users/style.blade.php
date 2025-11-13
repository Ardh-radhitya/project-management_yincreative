<style>
    /* Style untuk Input Form */
    .form-input {
        @apply focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow;
    }

    /* Tombol Utama (Biru Langit / Cyan) */
    .btn-primary {
        /* Base styles */
        @apply inline-block px-8 py-3 font-bold text-center uppercase align-middle transition-all border-0 cursor-pointer active:opacity-85 leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md;

        /* KITA PAKSA WARNA BACKGROUND DISINI AGAR PASTI MUNCUL */
        background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); /* Gradien Biru Argon */
        background-color: #2152ff; /* Warna cadangan */

        /* Border radius yang lebih kotak tapi halus */
        border-radius: 8px;

        /* Warna teks */
        color: #ffffff;

        /* Transisi yang lebih halus */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0);
        box-shadow: 0 4px 20px 0 rgba(33, 82, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    /* Efek shimmer/glow saat hover */
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    /* Efek Hover untuk Tombol Utama */
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px 0 rgba(33, 82, 255, 0.5);
        background-image: linear-gradient(310deg, #1a3dd4 0%, #1ab8d9 100%);
        color: #ffffff;
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 10px 0 rgba(33, 82, 255, 0.3);
    }

    /* Tombol Sekunder (Abu-abu) */
    .btn-secondary {
        @apply inline-block px-8 py-3 mr-3 font-bold text-center uppercase align-middle bg-gray-200 border-0 cursor-pointer leading-pro text-size-xs tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800;

        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-secondary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style Baru untuk Tombol Aksi di Tabel */
    .btn-action-edit {
        @apply inline-block px-6 py-2.5 font-semibold leading-tight text-center text-white uppercase text-size-xs;

        background-color: #64748b;
        border-radius: 6px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0) scale(1);
        box-shadow: 0 2px 8px rgba(100, 116, 139, 0.3);
        position: relative;
        overflow: hidden;
        color: #ffffff;
        font-weight: 600;
        min-width: 70px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action-edit::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-action-edit:hover {
        background-color: #475569;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 20px rgba(100, 116, 139, 0.5);
        color: #ffffff;
    }

    .btn-action-edit:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-action-delete {
        @apply inline-block px-6 py-2.5 font-semibold leading-tight text-center text-white uppercase text-size-xs;

        background-color: #ef4444;
        border-radius: 6px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(0) scale(1);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        position: relative;
        overflow: hidden;
        color: #ffffff;
        font-weight: 600;
        min-width: 70px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-action-delete::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-action-delete:hover {
        background-color: #dc2626;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        color: #ffffff;
    }

    .btn-action-delete:hover::before {
        width: 300px;
        height: 300px;
    }

    /* Style untuk Notifikasi Sukses */
    .alert-success {
        @apply relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-cyan border-slate-100;
         background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); /* Fix juga untuk alert */
    }
</style>
