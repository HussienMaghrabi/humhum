@extends('website.layouts.app')
@section('content')

    <!-- start details-product  -->
    <section class='details-product'>
        <div class='container'>
            <h2>{{$data['name_'.App::getLocale()]}} </h2>

            <div class='row'>
                <div class="col-md-5 col-xs-12">

                    <div class="carousel slide" id="carouselExampleControls" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $f = 1; @endphp
                            @foreach($image as $img)
                                <div class="carousel-item @if($f == 1)active @endif ">
                                    @php $f=2; @endphp
                                    <img class="d-block w-100" src="{{$img->image}}" alt="First slide">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" data-slide="prev" href="#carouselExampleControls" role="button">
                            <span class="fa fa-angle-left prev" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" data-slide="next" href="#carouselExampleControls" role="button">
                            <span class="fa fa-angle-right next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!-- slider -->
                </div>
                <!-- col -->
                <div class="col-md-4">
                    <div class="up">
                        {{--@foreach($data as $item)--}}
                            <h6>{{$data['name_'.App::getLocale()]}}</h6>
                            @foreach($data->price as $price)
                                <a href='vendor.html'>المتجر: {{$price->vendor['name_'.App::getLocale()]}}</a>
                                <h5>السعر : {{$price->price_after}}</h5>
                            @endforeach
                            <button class="btn">اضف الى سلة التسوق
                                <img src="{{ asset('storage/assets/website') }}/img/6.png">
                            </button>
                        {{--@endforeach--}}
                    </div>
                    <!-- up -->
                </div>
                <!-- col -->
                <div class="col-md-3">
                    <img class="ads" src="{{ asset('storage/assets/website') }}/img/18.png">
                </div>
                <!-- col -->
            </div>
        </div>
    </section>
    <!-- end details-product  -->
    <!-- start description -->
    <section class='description'>
        <div class='container'>
            <h2>تفاصيل المنتج </h2>
            <div class='row'>
                <div class='col-md-12'>
                        <p>{{$data['desc_'.App::getLocale()]}}</p>
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end description -->
    <!-- start rate -->
    <section class="rate ">
        <div class="container">
            <h2>تقييمات المستخدمين </h2>
            <div class="row">
                <div class="col-md-6 text-center">
                    <form>
                        <h3 class="text-center">قيم المنتج</h3>
                        <div class="starratings risingstar d-flex justify-content-center flex-row-reverse">
                            <input id="star5" name="rating" type="radio" value="5">
                            <label for="star5" title="5 star"></label>
                            <input id="star4" name="rating" type="radio" value="4">
                            <label for="star4" title="4 star"></label>
                            <input id="star3" name="rating" type="radio" value="3">
                            <label for="star3" title="3 star"></label>
                            <input id="star2" name="rating" type="radio" value="2">
                            <label for="star2" title="2 star"></label>
                            <input id="star1" name="rating" type="radio" value="1">
                            <label for="star1" title="1 star"></label>
                        </div>
                    </form>
                </div>
                <!-- col -->
                <div class="col-md-6 text-center">
                    <h3>تقييمات المستخدمين</h3>
                    <i class='fa fa-star rate'>
                        <span>{{ $product->rate }}</span>
                    </i>
                    </h2>
                    @foreach($product->rates as $rate)
                        <div class="comment">
                            <div class="name">
                                <img src="{{ $rate->User->image }}">
                                <h5>{{ $rate->User->name }}</h5>
                            </div>
                            <!-- name -->
                            <p>{{ $rate->comment }}</p>
                            <div class="stars">
                                <div class="starrating risingstar d-flex justify-content-end flex-row-reverse">
                                    @for($star=1; $star<=(5-$rate->rate); $star++)
                                        <label style="color: #8E8E93"></label>
                                    @endfor
                                    @for($star=1; $star<=$rate->rate; $star++)
                                        <label></label>
                                    @endfor
                                </div>
                            </div>
                            <!-- stars -->
                        </div>
                @endforeach
                    <!-- stars -->
                </div>
                <!-- col -->

            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end rate -->
    <!-- start available -->
    <section class="available">
        <div class="container">
            <h2>متوفرة من بائعين اخرين</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="parent">
                        <img src="{{ asset('storage/assets/website') }}/img/13.jpg">
                        <ul class="list-unstyled">
                            <li>
                                <h1>البائع : بندة ماركت</h1>
                                <span>
                                    <i class="fa fa-star">
                                    </i>
                                    4.3
                                </span>

                            </li>
                            <li>
                                <h6>السعر : 300 جنيه</h6>
                            </li>
                            <li>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat animi, adipisci nostrum
                                    sed, suscipit et consequatur sequi minima iste, consectetur quidem ex! Distinctio animi
                                    explicabo ipsa at, non tenetur modi.</p>
                            </li>
                        </ul>
                        <button class='btn btn-lg'> أضف الى عربه التسوق
                            <img src='{{ asset('storage/assets/website') }}/img/6.png'>
                        </button>
                    </div>
                    <!-- parent -->
                </div>
                <!-- col -->
                <div class="col-md-12">
                    <div class="parent">
                        <img src="{{ asset('storage/assets/website') }}/img/13.jpg">
                        <ul class="list-unstyled">
                            <li>
                                <h1>البائع : بندة ماركت</h1>
                                <span>
                                    <i class="fa fa-star">
                                    </i>
                                    4.3
                                </span>

                            </li>
                            <li>
                                <h6>السعر : 300 جنيه</h6>
                            </li>
                            <li>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat animi, adipisci nostrum
                                    sed, suscipit et consequatur sequi minima iste, consectetur quidem ex! Distinctio animi
                                    explicabo ipsa at, non tenetur modi.</p>
                            </li>
                        </ul>
                        <button class='btn btn-lg'> أضف الى عربه التسوق
                            <img src='{{ asset('storage/assets/website') }}/img/6.png'>
                        </button>
                    </div>
                    <!-- parent -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end available -->

@endsection