@php
$headers = [
        $resource['header'] => '#',
    ];

        $boxes = [
              [
                'title' => __('dashboard.ADMINS'),
                'icon'  => 'user-secret',
                'color' => 'aqua',
                'data'  => $statistics['admins'],
                'route' => 'admin.admins'
              ],
              [
                'title' => __('dashboard.USERS'),
                'icon'  => 'users',
                'color' => 'aqua',
                'data'  => $statistics['users'],
                'route' => 'admin.users'
              ],
              [
                'title' => __('dashboard.STORES'),
                'icon'  => 'cutlery',
                'color' => 'aqua',
                'data'  => $statistics['vendors'],
                'route' => 'admin.vendors'
              ],
              [
                'title' => __('dashboard.BANNERS'),
                'icon'  => 'buysellads',
                'color' => 'aqua',
                'data'  => $statistics['banners'],
                'route' => 'admin.banners'
              ],
              [
                'title' => __('dashboard.CATEGORIES'),
                'icon'  => 'bookmark',
                'color' => 'aqua',
                'data'  => $statistics['categories'],
                'route' => 'admin.categories'
              ],
              [
                'title' => __('dashboard.SUBCATEGORIES'),
                'icon'  => 'bookmark',
                'color' => 'aqua',
                'data'  => $statistics['subcategories'],
                'route' => 'admin.subcategories'
              ],
              [
                'title' => __('dashboard.SUB2CATEGORIES'),
                'icon'  => 'bookmark',
                'color' => 'aqua',
                'data'  => $statistics['sub2categories'],
                'route' => 'admin.sub2categories'
              ],
              [
                'title' => __('dashboard.PRODUCTS'),
                'icon'  => 'shopping-bag',
                'color' => 'aqua',
                'data'  => $statistics['product'],
                'route' => 'admin.product'
              ],
              [
                'title' => __('dashboard.PRODUCTS_VENDOR'),
                'icon'  => 'check-square-o',
                'color' => 'aqua',
                'data'  => $statistics['requestProducts'],
                'route' => 'admin.requestProducts'
              ],
              [
                'title' => __('dashboard.CITIES'),
                'icon'  => 'flag',
                'color' => 'aqua',
                'data'  => $statistics['cities'],
                'route' => 'admin.cities'
              ],
              [
                'title' => __('dashboard.CONTACTS'),
                'icon'  => 'address-card',
                'color' => 'aqua',
                'data'  => $statistics['contacts'],
                'route' => 'admin.contacts'
              ],
              [
                'title' => __('dashboard.COMPLAINTS'),
                'icon'  => 'comments',
                'color' => 'aqua',
                'data'  => $statistics['complaints'],
                'route' => 'admin.complaints'
              ],
              [
                'title' => __('dashboard.QUESTIONS'),
                'icon'  => 'question',
                'color' => 'aqua',
                'data'  => $statistics['question'],
                'route' => 'admin.questions'
              ],
              [
                'title' => __('dashboard.ORDERS'),
                'icon'  => 'shopping-cart',
                'color' => 'aqua',
                'data'  => $statistics['order'],
                'route' => 'admin.orders'
            ],
              [
                'title' => __('dashboard.OFFERS'),
                'icon'  => 'usd',
                'color' => 'aqua',
                'data'  => $statistics['offers'],
                'route' => 'admin.offers'
              ],

            ];

@endphp
@extends('dashboard.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
@include('dashboard.components.header',$resource)
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
