@php
    $headers = [
            $resource['header'] => '#',
        ];
    $tableCols = [
         __('dashboard.Product'),
         __('dashboard.Description'),
         __('dashboard.SubCategories'),
         __('dashboard.discount percentage'),
         __('dashboard.maximum'),
         __('dashboard.Image'),
         __('dashboard.Images'),

       ];
@endphp
@extends('dashboard.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
    @include('dashboard.components.header')
    <div class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>

                <div class="box-tools">
                    <form class="input-group input-group-sm" style="width: 150px;" action="{{route($resource['route'].'.search', ['lang' => App::getLocale()])}}" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="text" class="form-control pull-right" placeholder="{{__('dashboard.Search')}}" style="width:150px">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default" title="Search"><i class="fa fa-search"></i></button>
                            <a href="{{route($resource['route'].'.create', ['lang' => App::getLocale()])}}" class="btn btn-default" title="New Item"><i class="fa fa-plus"></i></a>
                            <a href="#" class="btn btn-default delete_all disabled" data-toggle="modal" data-target="#danger_all" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>
                        </div>
                    </form>
                    @include('dashboard.components.dangerModalMulti')
                </div>
            </div>
        <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {!! Form::open(['method'=>'DELETE', 'route'=> [$resource['route'].'.multiDelete', App::getLocale()], 'class'=>'delete-form'])!!}
                    @if(count($data) == 0)
                        <div class="col-xs-12">
                            <h4> {{ __('dashboard.No Data') }}</h4>
                            <p>{{ __('dashboard.Add Link') }}  <b><a href="{{route($resource['route'].'.create', App::getLocale())}}">{{ __('dashboard.here') }}</a></b>.</p>
                        </div>
                    @else
                        <table class="table table-hover">
                            <tr>
                                @foreach($tableCols as $col)
                                    <td><strong>{{ $col }}</strong></td>
                                @endforeach
                                <td><strong>{{__('dashboard.Actions')}}</strong></td>
                                <td><strong><input type="checkbox" id="master"></strong></td>
                            </tr>
                            <br>
                            @foreach($data as $item)
                                @php $images = \App\Models\ProductImage::where('product_id', $item->Product->id)->count();@endphp
                                <tr class="tr-{{ $item->id }}">
                                    <td>{{ $item->Product['name_'.App::getLocale()] }}</td>
                                    <td>{{ $item->Product['desc_'.App::getLocale()] }}</td>
                                    <td>
                                        @php $category =  $item->Product->sub_sub_category['name_'.App::getLocale()] @endphp
                                        @if($category)
                                            {{$category ." / ". $item->Product->sub_category['name_'.App::getLocale()] }}
                                        @else
                                            {{ $item->Product->sub_category['name_'.App::getLocale()]}}
                                        @endif

                                    </td>
                                    <td>{{$item->cost}}</td>
                                    <td>{{$item->maximum}}</td>
                                    <td>
                                        @if($item->Product->image == NULL)
                                            <i class="fa fa-fw fa-image"> </i>
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#img_modal_{{$item->id}}" title="Photo">
                                                <i class="fa fa-fw fa-image"> </i>
                                            </a>
                                                                                        @include('dashboard.components.imageModal', ['id' => $item->id,'img' => $item->image])
                                        @endif
                                    </td>
                                    <td>
                                        @if($images > 0)
                                            <a href="{{ route('admin.productImages.index', [App::getLocale(), $item->Product->id]) }}">{{ $images }}</a></td>
                                    @else
                                        {{ $images }}
                                    @endif

                                    <td>

                                         {{--<a href="{{ route($resource['route'].'.show', [App::getLocale(),$item->id]) }}" title="show"><i class="fa fa-fw fa-eye text-light-blue"></i></a>--}}
                                        <a href="{{ route($resource['route'].'.edit', [App::getLocale(), $item->id]) }}" title="edit"><i class="fa fa-fw fa-edit text-yellow"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#danger_{{$item->id}}" title="Delete"><i class="fa fa-fw fa-trash text-red"></i></a>

                                    </td>
                                    <td><input type="checkbox" class="sub_chk" name="checked[]" value="{{$item->id}}"></td>
                                </tr>
                                @include('dashboard.components.dangerModal', ['user_name' => $item->name, 'id' => $item->id, 'resource' => $resource['route']])
                                @include('dashboard.components.imageModal', ['id' => $item->id,'img' => $item->Product->image])
                             @endforeach
                        </table>
                    @endif
                {!! Form::close()!!}
            </div>
        </div>
    </div>
    <div class="text-center" >
        {{ $data->links() }}
    </div>
@endsection
