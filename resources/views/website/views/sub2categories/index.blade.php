@extends('website.layouts.app')
@section('content')
@include('website.includes.slider')

<!-- start recommended-products -->
<section class="recommended-products">
    <div class="container">
        @foreach($subcategory as $item)
            <h2>{{ $item['name_'.App::getLocale()]}}</h2>
        @endforeach
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-3 col-xs-12">
                    <div class="parent">
                        <i class="fa fa-star-o fav"></i>
                        <a href="{{route('web.products.show', [App::getLocale(), $item->id, 'sub2categories'])}}">
                            <img src="{{$item->image}} "alt>
                            <p>{{$item['name_'.App::getLocale()]}}</p>
                        </a>
                        <!-- a -->
                        <img class="cartPlus" src="{{ asset('storage/assets/website') }}/img/6.png">
                    </div>
                    <!-- parent -->
                </div>
                <!-- col -->
            @endforeach
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- end recommended-products -->

@endsection