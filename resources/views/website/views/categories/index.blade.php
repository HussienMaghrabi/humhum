@extends('website.layouts.app')
@section('content')

    <!-- start all-categories -->
    <section class='all-categories'>
        <div class='container'>
            <div class='row'>
                @foreach($data as $item)
                    <div class='col-md-4 col-xs-12'>
                    <div class='parent'>
                        <h2 class='text-center'>{{ $item['name_'.App::getLocale()]}}</h2>
                        <ul class='list-unstyled'>
                            <li>
                                <a href='{{route('web.subcategories.show', [App::getLocale(), $item->id])}}'>
                                    @foreach($item->category as $sub)
                                    {{$sub['name_'.App::getLocale()]}}<br>
                                    @endforeach
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
                <!-- col -->

            </div>
            <!-- row -->
        </div>
        <!-- conatiner -->
    </section>
    <!-- end all-categories -->

@endsection