<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'soft-bg': '#F0F4F8',
                        'soft-text': '#5A6B7B',
                        'soft-primary': '#7C9CBF',
                        'soft-secondary': '#A9B8C9',
                        'custom-btn': '#056ae7',
                        'custom-btn-hover': '#0456b9',
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-custom-btn {
                background-color: #056ae7;
            }
            .hover\:bg-custom-btn-hover:hover {
                background-color: #000;
            }
        }
    </style>
</head>
<body class="bg-soft-bg text-soft-text h-full">
    <div id="app" class="h-full flex flex-col">
        @yield('content')
    </div>
</body>
</html>