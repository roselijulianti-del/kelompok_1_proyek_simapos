<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900 ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="website icon" type="img" href="{{ asset('img/elsimil.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body class="h-full">
    {{ $slot }}
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.querySelector('.success');
        const alertBox = document.getElementById('alert-success');

        if (closeBtn && alertBox) {
            closeBtn.addEventListener('click', function() {
                alertBox.classList.add('opacity-0');
                setTimeout(() => alertBox.remove(), 300);
            });
        }
    });
</script>

</html>
