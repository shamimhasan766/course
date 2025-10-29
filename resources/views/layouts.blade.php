<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>
        @stack('title', 'Course Web Page')
    </title>
</head>

<body>
    <div class="max-w-6xl mx-auto p-6">
        <nav class="flex justify-between items-center mb-6 border-b pb-3">
            <div class="flex space-x-6">
                <a href="{{ route('courses.index') }}"
                    class="{{ request()->routeIs('courses.index')
                        ? 'text-red-600 font-semibold'
                        : 'text-gray-700 hover:text-red-600 font-medium' }}">
                    Courses
                </a>

                <a href="{{ route('courses.create') }}"
                    class="{{ request()->routeIs('courses.create')
                        ? 'text-red-500 font-semibold'
                        : 'text-gray-700 hover:text-red-600 font-medium' }}">
                    Create Course
                </a>
            </div>
        </nav>

        @yield('content')
    </div>
    @stack('script')
</body>

</html>
