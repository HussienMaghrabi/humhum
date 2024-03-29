@php
    $name = App\Models\Product::where('id', $value)->first();
        $headers = [
               $name['name_'.App::getLocale()] => route('vendor.products.index', App::getLocale()),
               __('vendor.'.$resource['header']) => '#',
           ];
@endphp
@extends('vendor.layouts.app')
@section('title', __('vendor.'.$resource['title']))
@section('styles')<link rel="stylesheet" href="{{ asset('storage/assets/admin/dist/css/image.css') }}">@endsection
@section('content')
    @include('vendor.components.header1')
    <div class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>

                <div class="box-tools" style="text-align: {{ App::getLocale() == 'ar' ? 'left' : 'right' }}">
                    <div class="input-group-btn">
                        <a href="{{route($resource['route'].'.create', ['lang' => App::getLocale(), 'value' => $value])}}" class="btn btn-default" title="New Item"><i class="fa fa-plus"></i></a>
                        <div class="hidden"><input type="checkbox" id="master"></div>
                        <button class="btn btn-default do-it"><i class="fa fa-check text-red"></i></button>
                        <script>
                            $('.do-it').on('click', function () {
                                $("#master").click();
                            });
                        </script>
                        <a href="#" class="btn btn-default delete_all disabled" data-toggle="modal" data-target="#danger_all" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>
                    </div>
                </div>
                @include('vendor.components.dangerModalMulti')
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" style="child-align: right">
                @if(count($data) == 0)
                    <div class="col-xs-12">
                        <h4> {{ __('dashboard.No Data') }}</h4>
                        <p>{{ __('dashboard.Add Link') }}  <b><a href="{{route($resource['route'].'.create', App::getLocale(), $value)}}">{{ __('dashboard.here') }}</a></b>.</p>
                    </div>
                @else<br>
                {!! Form::open(['method'=>'DELETE', 'route'=> [$resource['route'].'.multiDelete', App::getLocale(), $value], 'class'=>'delete-form'])!!}
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-md-2 image-{{$item->id}}">
                            <div class="text-center" style="margin-top: 5px">
                                <input type="checkbox" class="sub_chk" name="checked[]" value="{{$item->id}}">
                            </div>
                            <figure class="snip0013">
                                <img src="{{ $item->image }}" height="150px" width="150px" alt="sample32"/>
                                <div>
                                    <a href="{{ route($resource['route'].'.edit', ['lang' => App::getLocale(), 'value' => $value,'id' =>$item->id]) }}"><i class="fa fa-edit left-icon"></i></a>
                                    <a href="#"data-toggle="modal" data-target="#danger_{{$item->id}}"><i class="fa fa-trash right-icon"></i></a>
                                </div>
                            </figure>
                        </div>
                        {{--<a href="{{ route($resource['route'].'.edit', [App::getLocale(), $item->id]) }}" title="edit"><i class="fa fa-fw fa-edit text-yellow right-icon"></i></a>--}}
                        {{--<a href="#" data-toggle="modal" data-target="#danger_{{$item->id}}" title="Delete"><i class="fa fa-fw fa-trash text-red left-icon"></i></a>--}}
                        @include('vendor.components.dangerModalImage', ['user_name' => $item->name, 'id' => $item->id, 'value' => $value, 'resource' => $resource['route']])
                    @endforeach<br>
                </div>
                {!! Form::close()!!}
                @endif
            </div>
        </div>
    </div>
@endsection
