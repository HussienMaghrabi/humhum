<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Driver;
use App\Models\FcmToken;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Rate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class OrderController extends Controller
{
    private $resources = 'orders';
    private $resource = [
        'route' => 'admin.orders',
        'view' => "orders",
        'icon' => "shopping-cart",
        'title' => "ORDERS",
        'action' => "",
        'header' => "Orders"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::orderBy('id', 'desc')->paginate(10);
        $resource = $this->resource;
        return view('dashboard.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {

        $data = OrderCart::where('order_id',$id)
            ->paginate(10);
        $resource = $this->resource;
        $resource['action'] = 'Show';
        return view('dashboard.views.'.$this->resources.'.show',compact('data', 'resource'));

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
        $item = Order::findOrFail($id);
        $status = Status::select("name_$lang as name", 'id')->get();
        return view('dashboard.views.' .$this->resources. '.edit', compact('item', 'resource','status'));
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
            'status_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            flashy()->error($validator->errors()->all()[0]);
            return back();
        }
        $item = Order::find($id);
        $item->update($request->all());

        $user = $item->user_id;
        $name = $item->status->name_ar;
        $notification['title'] = 'تم تعديل حالة الطلب';
        $notification['body'] = "طلبك رقم $item->order_number $name";
        $notification['id'] = $id;
        $notification['fcm_token'] = FcmToken::Where('user_id', $user)->pluck('fcm_token');
        $this->pushNotification($notification);


        App::setLocale($lang);
        flashy(__('dashboard.updated'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        OrderCart::findOrFail($id)->delete();
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        App::setLocale($lang);
        foreach (\request('checked') as $id)
        {
             OrderCart::findOrFail($id)->delete();

        }

        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = OrderCart::select(
            'order_carts.order_id',
            'order_carts.cart_id',
            'order_carts.vendor_id'
        )
            ->join('vendors', 'vendors.id', '=', 'order_carts.vendor_id')
            ->where('vendors.name_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('vendors.name_en', 'LIKE', '%'.$request->text.'%')
//            ->orWhere('cost_delivery', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('dashboard.views.' .$this->resources. '.index', compact('data', 'resource'));
    }
}
