@php
$headers = [
        $resource['header'] => '#',
    ];

        $boxes = [

            [
                'title' => __('dashboard.PRODUCTS'),
                'icon'  => 'shopping-bag',
                'color' => 'aqua',
                'data'  => $statistics['product'],
                'route' => 'vendor.products'
            ],
            [
                'title' => __('dashboard.ORDERS'),
                'icon'  => 'shopping-cart',
                'color' => 'aqua',
                'data'  => $statistics['order'],
                'route' => 'vendor.orders'
            ],
            [
                'title' => __('dashboard.PRICES'),
                'icon'  => 'shopping-cart',
                'color' => 'aqua',
                'data'  => $statistics['price'],
                'route' => 'vendor.price'
            ],

            ];

@endphp
@extends('vendor.layouts.app')
@section('title', 'Store Home')
@section('content')
@include('vendor.components.header',$resource)
<section class="content">
  <div class="row">

    @foreach ($boxes as $box)
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-{{$box['color']}}">
          <div class="inner">
            <h3>{{$box['data']}}</h3>

            <p>{{$box['title']}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-{{$box['icon']}}"></i>
          </div>
          <a href="{{ route($box['route'].'.index', App::getLocale()) }}" class="small-box-footer"> {{__('dashboard.More info')}} <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    @endforeach

  </div>
</section>
@endsection
