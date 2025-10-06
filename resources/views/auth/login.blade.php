<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-sm text-white">
        <h2 class="text-2xl font-bold mb-6 text-center">Login to Y.in Creative</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 p-2 rounded font-semibold">
                Login
            </button>
        </form>
    </div>
</body>
</html>
