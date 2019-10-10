@extends('website.layouts.app')
@section('content')
    <section class='slider'>
        <div class='container'>
            <a class='offer' href='#'>عروض النهاردة
                <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
        </div>
    </section>
@include('website.includes.slider')

    <!-- start Recommended -->
    <section class="Recommended" id="factory">
            <div class="container">
                <div class="allTitle">
                    <h2>السلع الموصي بها </h2>
                    <a class="btn showAll" href="recommended-products.html">عرض الكل</a>
                </div>
                <div class="owl-carousel  owl-nav " id="#owl-demo">
                    @foreach($recommended as $item)
                        <div class="item">
                        <i class='fa fa-star-o fav'></i>
                        <a href="{{route('web.products.details', [App::getLocale(), $item->Product->id])}}">
                            <img src="{{$item->Product->image}}" alt>
                            <p>{{$item->Product['name_'.App::getLocale()]}}</p>
                            <div class="addCart">
                                <h1>{{$item->price_after}} جنيه</h1>
                                <h6>بدلا من
                                    <del>{{$item->price_before}}</del>
                                </h6>
                            </div>
                            <!-- addCart -->
                        </a>
                        <img class="cartPlus" src="{{ asset('storage/assets/website') }}/img/6.png">
                    </div>
                    @endforeach
                </div>
                <!-- owl-carousel -->
            </div>
            <!-- container -->
        </section>
    <!-- end Recommended -->
    <!-- start popular -->
    <section class="popular" id="factory">
        <div class="container">
            <div class="allTitle">
                <h2>السلع الشائعة </h2>
                <a class="btn showAll" href="popular-product.html">عرض الكل</a>
            </div>
            <div class="owl-carousel  owl-nav " id="#owl-demo">
                @foreach($popular as $item)
                    <div class="item">
                    <i class="fa fa-star-o fav"></i>
                    <a href="{{route('web.products.details', [App::getLocale(), $item->Product->id])}}">
                        <img src="{{$item->Product->image}}" alt>
                        <p>{{$item->Product['name_'.App::getLocale()]}}</p>
                        <div class="addCart">
                            <h1>{{$item->price_after}} جنيه</h1>
                            <h6>بدلا من
                                <del>{{$item->price_before}}</del>
                            </h6>
                        </div>
                        <!-- addCart -->
                    </a>
                    <img class="cartPlus" src="{{ asset('storage/assets/website') }}/img/6.png">
                </div>
                @endforeach
            </div>
            <!-- owl-carousel -->
        </div>
        <!-- container -->
    </section>
    <!-- end popular -->
    <!-- start seller -->
    <section class="seller">
        <div class="container">
            <div class="allTitle">
                <h2>السلع الأكثر مبيعا </h2>
                <a class="btn showAll" href="seller.html">عرض الكل</a>
            </div>
            <div class="owl-carousel  owl-nav " id="#owl-demo">
                @foreach($seller as $item)
                    <div class="item">
                    <i class="fa fa-star-o fav"></i>
                    <a href="{{route('web.products.details', [App::getLocale(), $item->Product->id])}}">
                        <img src="{{$item->Product->image}}" alt>
                        <p>{{$item->Product['name_'.App::getLocale()]}}</p>
                        <div class="addCart">
                            <h1>{{$item->price_after}} جنيه</h1>
                            <h6>بدلا من
                                <del>{{$item->price_before}}</del>
                            </h6>
                        </div>
                        <!-- addCart -->
                    </a>
                    <img class="cartPlus" src="{{ asset('storage/assets/website') }}/img/6.png">
                </div>
                @endforeach
            </div>
            <!-- owl-carousel -->
        </div>
        <!-- container -->
    </section>
    <!-- end seller -->
    <!-- start subscribe -->
    <section class='subscribe'>
        <div class='container'>
            <div class='col-md-12'>
                <form class='row'>
                    <div class="col-md-3">
                        <span>اشترك لتصلك احدث العروض</span>
                    </div>
                    <div class="input-group mb-3 col-md-9">
                        <input class="form-control " type="text" aria-describedby="basic-addon1" aria-label placeholder='ادخل بريدك الاليكترونى هنا'>
                        <div class="input-group-prepend">
                            <button class="btn btn-lg" type="button">اشترك</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <!-- end subscribe -->

@endsection