<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-custom-btn {
                background-color: #056ae7;
            }
            .hover\:bg-custom-btn-hover:hover {
                background-color: #0456b9;
            }
        }
    </style>
</head>
<body class="bg-soft-bg text-soft-text">
    <div id="app" class="min-h-screen flex flex-col">
        <main class="flex-grow container mx-auto px-4 py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>