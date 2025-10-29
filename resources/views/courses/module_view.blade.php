@extends('layouts')
@section('content')
    <div>
        @foreach ($course->modules as $module)
            <div id="" class="bg-gray-700 rounded-lg p-5 border border-black mb-3">

                <div class="mb-4">
                    <h4 class="text-white font-bold">Module Title: {{ $module->title }}</h4>
                </div>

                <div class="space-y-3">
                    <h5 class="text-green-500 font-bold">Contents</h5>
                    @foreach ($module->contents as $content)
                        <div class="bg-pink-100 rounded-lg p-2 mb-3">
                            <p class="mb-2">Content Type : {{ $content->type }}</p>
                            <p>Content Value :
                                @if ($content->type === 'image' || $content->type === 'video')
                                    <a target="_blank" href="{{ asset($content->value) }}"
                                        class="text-sm px-2 py-1 text-white bg-teal-500">View</a>
                                @else
                                    {{ $content->value }}
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
