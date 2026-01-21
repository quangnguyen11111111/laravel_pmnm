<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bàn cờ</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="grid"
     style="grid-template-columns: repeat({{ $n }}, 60px);">

    @for ($row = 0; $row < $n; $row++)
        @for ($col = 0; $col < $n; $col++)
            <div class="w-[60px] h-[60px]
                {{ ($row + $col) % 2 == 0 ? 'bg-[#8B4513]' : 'bg-black' }}">
            </div>
        @endfor
    @endfor
</div>
</body>
</html>
