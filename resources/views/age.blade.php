<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')  
</head>
<body>
@if (session('error'))
    <div class="alert alert-danger bg-red-200 text-red-800 rounded p-4">
        {{ session('error') }}
    </div>
@endif
    <div class="min-h-screen flex items-center justify-center bg-gray-100 ">
        <form action="{{ route('storeAge') }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            @csrf
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Nhập tuổi của bạn</label>
                <input type="number" name="age" id="age" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Gửi
                </button>
            </div>
        </form>
    </div>
</body>
</html>