<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class SubSubCategoryController extends Controller
{
    private $resources = 'sub2categories';
    private $resource = [
        'route' => 'admin.sub2categories',
        'view' => "sub2categories",
        'icon' => "bookmark",
        'title' => "SUB2CATEGORIES",
        'action' => "",
        'header' => "Sub2Categories"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubSubCategory::orderBy('sort')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang)
    {
        $resource = $this->resource;
        $resource['action'] = 'Create';
        $categories = Category::select("name_$lang as name", 'id')->get();
        $subcategories = SubCategory::select("name_$lang as name", 'id')->where('category_id', request('category_id'))->get();
        return view('dashboard.views.'.$this->resources.'.create',compact( 'resource', 'categories','subcategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lang)
    {
        $rules =  [
            'sub_category_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'image' => 'required',
            'sort' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }


        $inputs = $request->except('image');
        if ($request->image)
        {
            $inputs['image'] =$this->uploadFile($request->image, 'subsubcategory');
        }

        SubSubCategory::create($inputs);
        App::setLocale($lang);
        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = SubSubCategory::findOrFail($id);
        $categories = Category::select("name_$lang as name", 'id')->get();
        $subcategories = SubCategory::select("name_$lang as name", 'id')->where('category_id', $item->category_id)->get();
        return view('dashboard.views.' .$this->resources. '.edit', compact('item', 'resource', 'categories','subcategories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        $rules =  [
            'name_ar' => 'required',
            'name_en' => 'required',
            'sort' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }
        $inputs = $request->except('image');
        $item = SubSubCategory::findOrFail($id);
        if ($request->image)
        {
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $inputs['image'] =$this->uploadFile($request->image, 'subsubcategory');
        }

        SubSubCategory::find($id)->update($inputs);
        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSubCategory  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $item = SubSubCategory::findOrFail($id);
        if (strpos($item->image, '/uploads/') !== false) {
            $image = str_replace( asset('').'storage/', '', $item->image);
            Storage::disk('public')->delete($image);
        }
        $item->delete();
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            $item = SubSubCategory::findOrFail($id);
            if (strpos($item->image, '/uploads/') !== false) {
                $image = str_replace( asset('').'storage/', '', $item->image);
                Storage::disk('public')->delete($image);
            }
            $item->delete();

        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = SubSubCategory::select(
            'sub_sub_categories.name_ar',
            'sub_sub_categories.name_en',
            'sub_sub_categories.sub_category_id',
            'sub_sub_categories.image'
        )
            ->join('sub_categories', 'sub_categories.id', '=', 'sub_sub_categories.sub_category_id')
            ->Where('sub_categories.name_en', 'LIKE', '%'.$request->text.'%')
            ->orWhere('sub_categories.name_ar', 'LIKE', '%'.$request->text.'%')
            ->orwhere('sub_sub_categories.name_en', 'LIKE', '%'.$request->text.'%')
            ->orWhere('sub_sub_categories.name_ar', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }

    public function ajax($lang){
        $subcategories = SubCategory::select("name_$lang as name", 'id')->where('category_id', request('category_id'))->get();
        return view('dashboard.views.' .$this->resources. '.sub', compact('subcategories'))->render();
    }
}
