    /** @type {import('tailwindcss').Config} */
    module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./public/argon-template/build/assets/js/**/*.js" // Scan juga JS dari Argon
    ],
    theme: {
        extend: {
        // Menyalin font family dari Argon
        fontFamily: {
            sans: ["Open Sans", "sans-serif"],
        },
        // Menyalin beberapa warna/konfigurasi jika diperlukan nanti
        },
    },
    plugins: [],
    }
