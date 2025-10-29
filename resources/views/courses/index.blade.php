@extends('layouts')
@section('content')
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Course Title</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Feature Video</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Modules</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $course->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $course->description }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($course->feature_video)
                            <a target="_blank" href="{{ asset($course->feature_video) }}"
                                class="text-sm px-2 py-1 text-white bg-teal-500">View</a>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($course->price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('courses.module.view', $course->id) }}"
                            class="text-sm px-2 py-1 text-white bg-red-500">Modules</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
