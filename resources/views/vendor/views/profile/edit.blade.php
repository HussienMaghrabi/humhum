@php
    $headers = [
            $resource['header'] => $resource['route'],
            $resource['action'] => '#',
        ];
@endphp
@extends('vendor.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
    @include('vendor.components.header')
    <div class="content">
<div class="box box-info">
  <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>
  </div>
    {{ Form::model($item, array('method' => 'PATCH', 'route' => [$resource['route'] , App::getLocale(), $item->id], 'class' => 'form-horizontal', 'files' => true)) }}
      <div class="box-body">
        @include('vendor.views.' .$resource['view']. '.form')
      </div>
      <div class="box-footer">
        <a href="{{route($resource['route'], App::getLocale())}}" class="btn btn-info col-md-1" style="margin-left:10px">{{__('dashboard.Cancel')}}</a>
        <button type="submit" class="btn btn-info pull-right col-md-1">{{__('dashboard.Update')}}</button>
      </div>
    {!!Form::close()!!}
</div>
</div>
@endsection
