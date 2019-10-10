@extends('website.layouts.app')
@section('content')

    <!-- start questions -->
    <section class='questions'>
        <div class='container'>
            <div class="col-md-12">
                @php $f = 1;@endphp
                @foreach($data as $item)
                    <div class="all-questions">
                    <button class="btn" type="button" data-toggle="collapse" data-target="@if($f == 1) #collapseExample @endif" aria-expanded="false" aria-controls="collapseExample">
                        @php $f=2; @endphp
                       {{$item['question_'.App::getLocale()]}}
                    </button>
                    <div class="collapse" id="collapseExample">

                        <div class="card card-body">
                            {{$item['answer_'.App::getLocale()]}}
                        </div>
                    </div>
                    <!-- collapse -->
                </div>
                @endforeach
            </div>
            <!-- col -->

        </div>
    </section>

    <!-- end questions -->

@endsection