<?php

namespace App\Http\Controllers\Category;

use App\Enums\ResponseCode;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $responseCode;

    public function __construct()
    {
        $this->responseCode = new ResponseCode();
    }

    public function createNewCategory($name = null, $slug = null, $lang = config('app.locale'), $description = null, $parentId = null, $isActive = true, $model = null)
    {
        try {
            $category = new Category();
            $category->setTranslations('name', [$lang => $name]);
            $category->setTranslations('description', [$lang => $description]);
            $category->slug = $slug;
            $category->parent_id = $parentId;
            $category->is_active = $isActive;
            $category->model = $model;
            $category->save();
            return $this->responseCode::SUCCESS;
        } catch (\Throwable $th) {
            return $this->responseCode::FAILED;
        }
    }

    public function updateCategory($id, $slug = null, $lang = config('app.locale'), $name = null, $description = null, $parentId = null, $isActive = true, $model = null)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->responseCode::NOT_FOUND;
            }
            $category->setTranslations('name', [$lang => $name]);
            $category->setTranslations('description', [$lang => $description]);
            $category->slug = $slug;
            $category->parent_id = $parentId;
            $category->is_active = $isActive;
            $category->model = $model;
            $category->save();
            return $this->responseCode::SUCCESS;
        } catch (\Throwable $th) {
            return $this->responseCode::FAILED;
        }
    }

    public function translateCategory($id, $lang = config('app.locale'), $name = null, $description = null)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->responseCode::NOT_FOUND;
            }
            $category->setTranslations('name', [$lang => $name]);
            $category->setTranslations('description', [$lang => $description]);
            $category->save();
            return $this->responseCode::SUCCESS;
        } catch (\Throwable $th) {
            return $this->responseCode::FAILED;
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->responseCode::NOT_FOUND;
            }
            $category->delete();
            return $this->responseCode::SUCCESS;
        } catch (\Throwable $th) {
            return $this->responseCode::FAILED;
        }
    }
}
