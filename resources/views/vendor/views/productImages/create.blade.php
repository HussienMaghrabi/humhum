@php
    $name = App\Models\Product::find($value);
        $headers = [
               $name['name_'.App::getLocale()] => route('vendor.products.index', App::getLocale()),
               __('dashboard.'.$resource['header']) => route($resource['route'].'.index', [App::getLocale(), $value]),
               __('dashboard.Create') => '#'

           ];
@endphp
@extends('vendor.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
    @include('vendor.components.header1')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>
            </div>

            {{ Form::open(array('route'=>[$resource['route']. '.store','lang'=>App::getLocale(), 'value'=>$value], 'method' => 'post','files'=>true, 'class' => 'form-horizontal')) }}
            <div class="box-body">
                @include('vendor.views.' .$resource['view']. '.form')
            </div>
            <div class="box-footer">
                <a href="{{route($resource['route'].'.index', [App::getLocale(), $value])}}" class="btn btn-info col-md-1" style="margin-left:10px">{{__('dashboard.Cancel')}}</a>
                <button type="submit" class="btn btn-info pull-right col-md-1">{{__('dashboard.Create')}}</button>
            </div>
            {!!Form::close()!!}

        </div>
    </div>

@endsection
