<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Module;
use App\Models\ModuleContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseService
{
    public function createCourse($request)
    {
        $newCourse = new Course();
        $newCourse->title = $request->title;
        $newCourse->description = $request->description;
        $newCourse->price = $request->price;
        if ($request->hasFile('feature_video')) {
            $video = $request->file('feature_video');
            $filename = time() . '_' . uniqid() . '.' . $video->getClientOriginalExtension();
            $path = $video->storeAs('videos', $filename);
            $newCourse->feature_video = $path;
        }

        $newCourse->save();

        $this->createModules($request, $newCourse->id);
        return $newCourse;
    }

    public function createModules($request, $course_id)
    {
        if ($request->modules) {
            foreach ($request->modules as $module) {
                $newModule = new Module();
                $newModule->course_id = $course_id;
                $newModule->title = $module['title'];
                $newModule->save();

                $this->createContents($module, $newModule->id);
            }
        }
    }

    public function createContents($module, $module_id)
    {
        if ($module['contents']) {
            foreach ($module['contents'] as $content) {
                $newContent = new ModuleContent();
                $newContent->module_id = $module_id;
                $newContent->type = $content['type'];
                if ($content['type'] === 'image' || $content['type'] === 'video') {
                    $file = $content['value'];
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('contents', $filename);
                    $newContent->value = $path;
                } else {
                    $newContent->value = $content['value'];
                }

                $newContent->save();
            }
        }
    }
}
