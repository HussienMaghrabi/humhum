@php

  $items = [
          [
            'route' => 'vendor.products.index',
            'icon'  => 'shopping-bag',
            'title' => __('dashboard.PRODUCTS')
          ],
          [
            'route' => 'vendor.orders.index',
            'icon'  => 'shopping-cart',
            'title' => __('dashboard.ORDERS')
          ],
          [
            'route' => 'vendor.price.index',
            'icon'  => 'shopping-cart',
            'title' => __('dashboard.PRICES')
          ],

      ];

@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="height:100vh;overflow-y:scroll">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      @foreach ($items as $item)
        <li>
          <a href=" {{ $item['route'] == NULL ? '#' : route($item['route'], App::getLocale()) }} ">
            <i class="fa fa-{{$item['icon']}}"></i>
            <span>{{ $item['title'] }}</span>
          </a>
        </li>
      @endforeach

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
