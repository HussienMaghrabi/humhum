<?php

namespace App\Http\Controllers\vendor;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class OrderController extends Controller
{
    private $resources = 'orders';
    private $resource = [
        'route' => 'vendor.orders',
        'view' => "orders",
        'icon' => "product-hunt",
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
        $data = OrderCart::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->select('order_id')
            ->groupBy('order_id')
            ->get();
        $data = Order::select('id','payment','address','vat','cost','user_id','city_id','status_id')
            ->whereIn('id',$data)
            ->paginate(10);

        $resource = $this->resource;
        return view('vendor.views.'.$this->resources.'.index',compact('data', 'resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($lang,$id)
    {
        //

        $cart = OrderCart::where('vendor_id',Auth::guard('vendor')->user()->id)
            ->where('order_id',$id)
            ->select('cart_id')
            ->groupBy('cart_id')
            ->get();
        $data = Cart::select('id','quantity','price','user_id','product_id','text')
            ->whereIn('id',$cart)
            ->paginate(10);
        $resource = $this->resource;
        $resource['action'] = 'Show';
        return view('vendor.views.'.$this->resources.'.show',compact('data', 'resource'));

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        OrderCart::findOrFail($id)->delete();

        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function multiDelete($lang)
    {
        foreach (\request('checked') as $id)
        {
            OrderCart::findOrFail($id)->delete();
        }
        App::setLocale($lang);
        flashy(__('dashboard.deleted'));
        return redirect()->route($this->resource['route'].'.index', $lang);
    }

    public function search(Request $request, $lang)
    {
        $resource = $this->resource;
        $data = product::where('name_ar', 'LIKE', '%'.$request->text.'%')
            ->orWhere('name_en', 'LIKE', '%'.$request->text.'%')
            ->paginate(10);
        App::setLocale($lang);
        return view('store.views.' .$this->resources. '.index', compact('data', 'resource'));
    }

}
