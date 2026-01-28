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
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <h1>Register</h1>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <form action="/auth/checkRegister" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        @csrf
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Repeat Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
                <div>
            <label for="student_id" class="block text-sm font-medium text-gray-700">Mã sinh viên</label>
            <input type="text" name="student_id" id="student_id" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="">
            <label for="class" class="block text-sm font-medium text-gray-700">Chọn lớp môn học</label>
            <select name="class" id="class" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="67Pm1">67Pm1</option>
                <option value="67Pm2">67Pm2</option>
            </select>
        </div>
        <div class="">
            <label for="gender" class="block text-sm font-medium text-gray-700">Chọn giới tính</label>
            <select name="gender" id="gender" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
        </div>
        <div>
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Register
            </button>
        </div>
    </form>
    </div>

</body>
</html>