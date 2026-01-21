<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin sinh viên</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-96">
        <h1 class="text-2xl font-bold text-center mb-6">
            Thông tin sinh viên
        </h1>

        <div class="space-y-4 text-lg">
            <p>
                <span class="font-semibold">Tên:</span>
                {{ $name }}
            </p>

            <p>
                <span class="font-semibold">MSSV:</span>
                {{ $mssv }}
            </p>
        </div>
    </div>

</body>
</html>
