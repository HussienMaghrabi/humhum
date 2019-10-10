@extends('website.layouts.app')
@section('content')

    <!-- start recommended-products -->
    <section class="recommended-products">
        <div class="container">

            <h2>{{$title}} </h2>

                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-3 col-xs-12">
                            <div class="parent">
                                <i class="fa fa-star-o fav"></i>
                                <a href="{{route('web.products.details', [App::getLocale(), $item->id])}}">
                                    <img src="{{$item->image}}" alt>
                                    <p>{{ $item['name_'.App::getLocale()]}}</p>
                                    <div class="addCart">
                                        @foreach($item->price as $price)
                                            <h1> جنيه{{$price->price_after}}</h1>
                                            <h6>بدلا من
                                                <del>{{$price->price_before}}</del>
                                            </h6>
                                        @endforeach
                                    </div>
                                    <!-- addCart -->
                                </a>
                                <!-- a -->
                                <img class="cartPlus" src="{{ asset('storage/assets/website') }}/img/6.png">
                            </div>
                            <!-- parent -->
                        </div>
                @endforeach
                <!-- col -->
                </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end recommended-products -->

@endsection