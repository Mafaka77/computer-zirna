<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use App\Models\Video;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    /**
     * CourseController constructor.
     */
    public function __construct()
    {
    }

    public function show(Request $request, Course $course)
    {
        try {
            $permit=$request->user()->tokenCan('view:course');
            if (!$permit) {
                throw  new \Exception('Permission denied', 403);
            }
            return $this->handleResponse($course->load(['videos','materials']), '');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function all(Request $request)
    {
        try {
            $permit=$request->user()->tokenCan('view:course');
            if (!$permit) {
                throw  new \Exception('Permission denied', 403);
            }
            return $this->handleResponse(Course::all(), '');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }

    public function create(Request $request)
    {
        try {
            $permit=$request->user()->tokenCan('create:course');
            if (!$permit) {
                throw new \Exception('Permission denied', 403);
            }
            $this->validate($request->only(['name', 'description','intro_url', 'thumbnail_url','price','videos']), [
                'name' => 'required',
                'intro_url' => 'required',
                'price' => 'required|numeric',
                'videos'=>'required'
            ]);

            $videos = Video::query()->findMany($request->get('videos'));
            $materials = Material::query()->findMany($request->get('materials'));

            $course = Course::create($request->only(['name', 'description', 'intro_url', 'thumbnail_url', 'price']));
            $course->videos()->sync($videos);
            $course->materials()->sync($materials);
            return $this->handleResponse($course, 'Course created successfully');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function update(Request $request,Course $course)
    {
        try {
            $permit=$request->user()->tokenCan('update:course');
            if (!$permit) {
                throw new \Exception('Permission denied', 403);
            }
            $this->validate($request->only(['name', 'description','intro_url', 'price','videos']), [
                'name' => 'required',
                'intro_url' => 'required',
                'price' => 'required|numeric',
                'videos'=>'required'
            ]);
            $course->name = $request->get('name');
            $course->description = $request->get('description');
            $course->price = $request->get('price');
            $course->intro_url = $request->get('intro_url');
            $course->thumbnail_url = $request->get('thumbnail_url');
            $course->save();

            $videos = Video::query()->findMany($request->get('videos'));
            $materials = Material::query()->findMany($request->get('materials'));
            $course->videos()->sync($videos);
            $course->materials()->sync($materials);

            return $this->handleResponse($course, 'Course updated successfully');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function delete(Request $request,Course $course)
    {
        try {
            $permit=$request->user()->tokenCan('delete:course');
            if (!$permit) {
                throw new \Exception('Permission denied', 403);
            }
            $course->delete();

            return $this->handleResponse(Course::all(), 'Course deleted successfully');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
}
