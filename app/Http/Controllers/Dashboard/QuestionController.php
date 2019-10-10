<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class QuestionController extends Controller
{
    private $resources = 'questions';
    private $resource = [
        'route' => 'admin.questions',
        'view' => "questions",
        'icon' => "question",
        'title' => "QUESTIONS",
        'action' => "",
        'header' => "Questions"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $data = CommonQuestion::orderBy('id')->paginate(10);
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

            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        CommonQuestion::create($request->all());
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
        $item = CommonQuestion::findOrFail($id);

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

            'question_ar' => 'required',
            'question_en' => 'required',
            'answer_ar' => 'required',
            'answer_en' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }

        CommonQuestion::find($id)->update($request->all());

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
        CommonQuestion::findOrFail($id)->delete();
        App::setLocale($lang);
//        flashy(__('dashboard.deleted'));
//        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            CommonQuestion::findOrFail($id)->delete();
        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = CommonQuestion::where('question_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('question_en', 'LIKE', '%'.$request->text.'%')
            ->orWhere('answer_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('answer_en', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
