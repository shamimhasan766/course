@extends('layouts')
@section('content')
    <div class="p-3">
        <form action="" onsubmit="saveForm(event)">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block font-bold mb-2" for="title">Course Title</label>
                    <input type="text" id="title" class="border-gray-600 border-1 w-full px-4 py-3 rounded-lg"
                        placeholder="Enter Course Title here..." required>
                </div>
                <div>
                    <label class="block font-bold mb-2" for="price">Price</label>
                    <input type="text" id="price" class="border-gray-600 border-1 w-full px-4 py-3 rounded-lg"
                        placeholder="Enter Course Price here...">
                </div>
            </div>
            <div class="">
                <label class="block font-bold mb-2" for="description">Description</label>
                <textarea name="description" id="description" cols="15" rows="5"
                    class="border-gray-600 border-1 w-full px-4 py-3 rounded-lg" placeholder="Enter Course Description here..."></textarea>
            </div>
            <div class="">
                <label class="block font-bold mb-2" for="video">Feature Video</label>
                <input type="file" id="video"
                    class="border-gray-600 border-1 w-full px-4 py-3 rounded-lg cursor-pointer">
            </div>

            <hr class="border-gray-700 my-6">
            <div class="mb-6">
                <button onclick="addModule()" class="bg-green-600 text-white font-medium px-4 py-2 rounded-lg"
                    type="button">
                    Add Module +
                </button>
            </div>

            <div id="modules" class="space-y-4">
                <div id="module_1" class="bg-gray-700 rounded-lg p-5 border border-black">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-medium text-white">Module 1</h3>
                        <button onclick="removeModule('module_1')" type="button"
                            class="bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center">
                            ×
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="text-white">Module Title</label>
                        <input type="text" class="border-gray-400 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white"
                            placeholder="Enter module title here....">
                    </div>

                    <button onclick="addContent('module_1')" type="button"
                        class="bg-blue-600 text-white font-medium px-3 py-2 rounded-lg mb-4">
                        Add Content +
                    </button>

                    <div id="module_1_contents" class="space-y-3">

                    </div>
                </div>
            </div>

            <div class="mt-6 flex gap-3 justify-end">
                <button type="submit" class="bg-teal-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-lg">
                    Create Course
                </button>
            </div>
        </form>
    </div>

    <script>
        let moduleCount = 1;
        let contentCount = 0;

        function addModule() {
            moduleCount++;
            const moduleId = `module_${moduleCount}`;

            const moduleHTML = `
                 <div id="${moduleId}" class="bg-gray-700 rounded-lg p-5 border border-black">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-medium text-white">Module ${moduleCount}</h3>
                        <button onclick="removeModule('${moduleId}')"
                            class="bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center">
                            ×
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="text-white">Module Title</label>
                        <input type="text"
                            class="border-gray-400 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white"
                            placeholder="Enter module title here....">
                    </div>

                    <button onclick="addContent('${moduleId}')"
                        class="bg-blue-600 text-white font-medium px-3 py-2 rounded-lg mb-4" type="button">
                        Add Content +
                    </button>

                    <div id="${moduleId}_contents" class="space-y-3">

                    </div>
                </div>
            `;

            document.getElementById('modules').insertAdjacentHTML('beforeend', moduleHTML);
        }

        // Remove module
        function removeModule(moduleId) {
            const module = document.getElementById(moduleId);
            if (module) {
                module.remove();
            }
        }

        function addContent(moduleId) {
            contentCount++;
            const contentId = `content_${contentCount}`;

            const contentHTML = `
                    <div id="${contentId}" class="bg-slate-900 border border-slate-700 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3 w-full">
                            <p class="font-medium text-white">
                                Content
                            </p>
                            <button onclick="removeContent('${contentId}')"
                                class="bg-red-500 hover:bg-red-600 text-white w-6 h-6 rounded flex items-center justify-center transition ml-2" type="button">
                                ×
                            </button>
                        </div>

                        <div class="content-body space-y-3">
                            <div>
                                <label class="block text-slate-400 text-xs font-medium mb-2">Content Type</label>
                                <select onchange="handleContentTypeChange('${contentId}', this.value)"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-slate-200">
                                    <option value="">Choose Content Type...</option>
                                    <option value="text">Text</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="link">Link</option>
                                </select>
                            </div>
                            <div id="${contentId}_dynamic" class="space-y-4">

                            </div>
                        </div>
                    </div>
                `;

            document.getElementById(`${moduleId}_contents`).insertAdjacentHTML('beforeend', contentHTML);
        }

        function removeContent(contentId) {
            const content = document.getElementById(contentId);
            if (content) {
                content.remove();
            }
        }

        // Save form
        function saveForm(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('price', document.getElementById('price').value);

            const featureVideo = document.getElementById('video').files[0];
            if (featureVideo) {
                formData.append('feature_video', featureVideo);
            }

            const modules = document.querySelectorAll('#modules > div');
            modules.forEach((moduleEl, mIndex) => {
                const moduleTitle = moduleEl.querySelector('input[type="text"]').value;
                formData.append(`modules[${mIndex}][title]`, moduleTitle);
                formData.append(`modules[${mIndex}][order]`, mIndex + 1);

                const contents = moduleEl.querySelectorAll('.content-body');
                contents.forEach((contentEl, cIndex) => {
                    const contentType = contentEl.querySelector('select')?.value || '';
                    const dynamicInput = contentEl.querySelector('[id$="_dynamic"] input');

                    formData.append(`modules[${mIndex}][contents][${cIndex}][type]`, contentType);

                    if (dynamicInput) {
                        if (dynamicInput.type === 'file') {
                            if (dynamicInput.files.length > 0) {
                                formData.append(`modules[${mIndex}][contents][${cIndex}][value]`,
                                    dynamicInput.files[0]);
                            }
                        } else {
                            formData.append(`modules[${mIndex}][contents][${cIndex}][value]`, dynamicInput
                                .value);
                        }
                    }
                });
            });

            fetch('/store', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert('Course Created successfully!');
                    window.location.href = '/';
                })
                .catch(error => {
                    console.error('Error saving course:', error);
                    alert('Something went wrong.');
                });
        }

        function handleContentTypeChange(contentId, type) {
            const dynamicContainer = document.getElementById(`${contentId}_dynamic`);
            let fieldsHTML = '';

            switch (type) {
                case 'video':
                    fieldsHTML = `
                <div>
                    <label class="block text-slate-400 text-xs font-medium mb-2">Choose Video</label>
                    <input type="file"
                        class="bg-slate-800 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white">
                </div>
            `;
                    break;

                case 'text':
                    fieldsHTML = `
                <div>
                    <label class="block text-slate-400 text-xs font-medium mb-2">Write your text</label>
                    <input type="text" placeholder="Enter your text content..."
                        class="bg-slate-800 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white">
                </div>
            `;
                    break;

                case 'image':
                    fieldsHTML = `
                <div>
                    <label class="block text-slate-400 text-xs font-medium mb-2">Choose image</label>
                    <input type="file"
                        class="bg-slate-800 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white">
                </div>
            `;
                    break;

                case 'link':
                    fieldsHTML = `
                <div>
                    <label class="block text-slate-400 text-xs font-medium mb-2">Link URL</label>
                    <input type="url" placeholder="https://..."
                        class="bg-slate-800 border-1 w-full px-4 py-3 rounded-lg mt-2 text-white">
                </div>
            `;

                    break;
            }

            dynamicContainer.innerHTML = fieldsHTML;
        }
    </script>
@endsection
