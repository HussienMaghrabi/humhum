@extends('website.layouts.app')
@section('content')

    <!-- start terms -->
    <section class='terms'>
        <div class='container'>
            <h2>سياسة البيع</h2>
            @foreach($data as $item)
                <p>{{$item['sell_policy_'.App::getLocale()]}}</p>
            @endforeach
        </div>
        <!-- container -->
    </section>
    <!-- end terms -->

@endsection