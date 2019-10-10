@extends('website.layouts.app')
@section('content')

    <section class="address">
        <div class="container">
            <div class="col-md-12">
                <form action ="{{ route('web.confirm-address.store', App::getLocale()) }}" method="POST" >
                    {{ csrf_field() }}

                    <h5>{{__('website.Governorate')}}</h5>
                    <div class="city">
                        <button class="btn btn-block" data-target="#collapseExample" data-toggle="collapse" type="button" aria-controls="collapseExample"
                                aria-expanded="false">
                            {{__('website.province')}}
                        </button>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                @foreach($data as $item)
                                <label class="container" id="city_id">
                                    {{$item['name_'.App::getLocale()]}}

                                    <input name="city_id" type="radio" class="5ra{{$item->id}}" value="{{$item->id}}" >
                                    <span class="checkmark"></span>
                                </label>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- city -->
                    <div class="form-group">
                        <input class="form-control" name="address" id="address" type="text" placeholder="{{__('website.Address')}}">
                    </div>
                    <button type="submit" class="btn btn-lg">{{__('website.Confirm')}}</button>
                </form>
            </div>
            <!-- col -->
        </div>
        <!-- container -->
    </section>

@endsection
@section('scripts')
    <script>
        {{--$document.getElementById("city_id").value= '{{$data->id}}'--}}

    </script>
@endsection
