@php

    $items = [
          [
            'route' => 'admin.home',
            'icon'  => 'tachometer',
            'title' => __('dashboard.DASHBOARD')
          ],

          [
            'route' => 'admin.admins.index',
            'icon'  => 'user-secret',
            'title' => __('dashboard.ADMINS')
          ],
          [
            'route' => 'admin.users.index',
            'icon'  => 'users',
            'title' => __('dashboard.USERS')
          ],
          [
            'route' => 'admin.vendors.index',
            'icon'  => 'cutlery',
            'title' => __('dashboard.STORES')
          ],
          [
            'route' => 'admin.banners.index',
            'icon'  => 'buysellads',
            'title' => __('dashboard.BANNERS')
          ],
          [
            'route' => 'admin.categories.index',
            'icon'  => 'bookmark',
            'title' => __('dashboard.CATEGORIES')
          ],
          [
            'route' => 'admin.subcategories.index',
            'icon'  => 'bookmark',
            'title' => __('dashboard.SUBCATEGORIES')
          ],
          [
            'route' => 'admin.sub2categories.index',
            'icon'  => 'bookmark',
            'title' => __('dashboard.SUB2CATEGORIES')
          ],
          [
            'route' => 'admin.product.index',
            'icon'  => 'shopping-bag',
            'title' => __('dashboard.PRODUCTS')
          ],
          [
            'route' => 'admin.requestProducts.index',
            'icon'  => 'check-square-o',
            'title' => __('dashboard.PRODUCTS_VENDOR')
          ],
          [
            'route' => 'admin.cities.index',
            'icon'  => 'flag',
            'title' => __('dashboard.CITIES')
          ],
          [
            'route' => 'admin.settings.index',
            'icon'  => 'cogs',
            'title' => __('dashboard.SETTINGS')
          ],
          [
            'route' => 'admin.contacts.index',
            'icon'  => 'address-card',
            'title' => __('dashboard.CONTACTS')
          ],
          [
            'route' => 'admin.complaints.index',
            'icon'  => 'comments',
            'title' => __('dashboard.COMPLAINTS')
          ],
          [
            'route' => 'admin.questions.index',
            'icon'  => 'question',
            'title' => __('dashboard.QUESTIONS')
          ],
          [
            'route' => 'admin.status.index',
            'icon'  => 'question',
            'title' => __('dashboard.STATUS')
          ],
          [
            'route' => 'admin.orders.index',
            'icon'  => 'shopping-cart',
            'title' => __('dashboard.ORDERS')
          ],
          [
            'route' => 'admin.offers.index',
            'icon'  => 'usd',
            'title' => __('dashboard.OFFERS')
          ],
          [
            'route' => 'admin.notifications.index',
            'icon'  => 'rss',
            'title' => __('dashboard.NOTIFICATIONS')
          ]

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
