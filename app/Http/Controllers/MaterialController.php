<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function all(Request $request)
    {
        try {
            return $this->handleResponse(Material::all());
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function index(Request $request)
    {
        try {
            return $this->handleResponse(Material::query()->paginate());
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function create(Request $request)
    {
        try {
            $this->validate($request->only(['title', 'description', 'file']), [
                'title' => 'required',
                'file' => 'required',
            ]);
            $file=$request->file('file');
            $mime = $file->getMimeType();

            $path = Storage::disk('local')->put("materials", $file);

            $material=Material::create(array_merge($request->only(['title', 'description']),['path'=>$path,'mime'=>$mime]));
            return $this->handleResponse(Material::query()->paginate(), 'Material created successfully');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }

    public function delete(Request $request,Material $material)
    {
        try {
            $material->forceDelete();
            Storage::delete($material->path);
            return $this->handleResponse(Material::query()->paginate(), 'Material deleted successfully');
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
    public function download(Request $request,Material $material)
    {
        try {
            $material=Storage::disk('local')->get($material->path);
            return $material;
        } catch (\Exception $exception) {
            return $this->handlingException($exception);
        }
    }
}
