<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class StatusController extends Controller
{
    private $resources = 'status';
    private $resource = [
        'route' => 'admin.status',
        'view' => "status",
        'icon' => "flag",
        'title' => "STATUS",
        'action' => "",
        'header' => "Status"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = Status::orderBy('id')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = $this->resource;
        $resource['action'] = 'Create';
        return view('dashboard.views.'.$this->resources.'.create',compact( 'resource'));

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

            'name_ar' => 'required',
            'name_en' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        Status::create($request->all());
        App::setLocale($lang);
        flashy(__('dashboard.created'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $resource = $this->resource;
        $resource['action'] = 'Edit';
        $item = Status::findOrFail($id);

        return view('dashboard.views.' .$this->resources. '.edit', compact('item', 'resource'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        $rules =  [

            'name_ar' => 'required',
            'name_en' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        Status::find($id)->update($request->all());

        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        Status::findOrFail($id)->delete();
        App::setLocale($lang);
//        flashy(__('dashboard.deleted'));
//        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            Status::findOrFail($id)->delete();
        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = Status::where('name_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
