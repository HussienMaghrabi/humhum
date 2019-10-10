@extends('website.layouts.app')
@section('content')

    <!-- start terms -->
    <section class='terms'>
        <div class='container'>
            <h2>شروط واحكام البائع</h2>
            @foreach($data as $item)
                <p>{{$item['term_sale_'.App::getLocale()]}}</p>
            @endforeach
        </div>
        <!-- container -->
    </section>
    <!-- end terms -->

@endsection