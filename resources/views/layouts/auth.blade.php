<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PinjemPak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .bg-custom-orange { background-color: #FF8C5F; }
        .text-custom-orange { color: #FF8C5F; }
    </style>
</head>
<body class="h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        @yield('content')
    </div>

</body>
</html>