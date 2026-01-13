/** @type {import('tailwindcss').Config} */
    export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./public/argon-template/**/*.js", // Scan JS template juga
    ],
    theme: {
        extend: {
        // Kalau Argon punya font khusus, definisikan di sini
        fontFamily: {
            sans: ['Open Sans', 'sans-serif'],
        }
        },
    },
    plugins: [],
    }
