@extends('website.layouts.app')
@section('content')
@include('website.includes.slider')

<section class='fruits'>
    <div class='container'>
            <div class='row'>
                @foreach($data as $item)
                    <div class='col-md-3 col-xs-12 text-center '>
                        <div class='parent'>

                            @if($item->sub_category()->count()==0 )
                                <a href='{{route('web.products.show', [App::getLocale(), $item->id, 'subcategories'])}}'>
                                    <img src='{{$item->image}}'>
                                    <h6>{{ $item['name_'.App::getLocale()]}}</h6>
                                </a>
                            @else
                                 <a href='{{route('web.subsubcategories.show', [App::getLocale(), $item->id])}}'>
                                     <img src='{{$item->image}}'>
                                     <h6>{{ $item['name_'.App::getLocale()]}}</h6>
                                 </a>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>

@endsection