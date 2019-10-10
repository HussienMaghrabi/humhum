@php
    $headers = [
            $resource['header'] => $resource['route'].'.index',
            $resource['action'] => '#',
        ];
@endphp
@extends('dashboard.layouts.app')
@section('title', __('dashboard.'.$resource['title']))
@section('content')
    @include('dashboard.components.header')
    <div class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-fw fa-{{$resource['icon']}}"> </i> {{__('dashboard.'.$resource['header'])}}</h3>
            </div>

            {{ Form::open(array('route'=>[$resource['route']. '.store', App::getLocale()],'files'=>true, 'class' => 'form-horizontal create')) }}
            <div class="box-body">
                @include('dashboard.views.' .$resource['view']. '.form')
            </div>
            <div class="box-footer">
                <a href="{{route($resource['route'].'.index', App::getLocale())}}" class="btn btn-info col-md-1" style="margin-left:10px">{{__('dashboard.Cancel')}}</a>
                <button type="submit" class="btn btn-info pull-right col-md-1">{{__('dashboard.Create')}}</button>
            </div>
            {!!Form::close()!!}
@include('dashboard.components.checkModal')
            <script>
                $('.create').on('submit', function (e) {
                    e.preventDefault();
                    var val = $('#product_id').val();
                    console.log(val);
                    $.ajax({
                        url: '{{route('admin.offers.ok',App::getLocale())}}',
                        dataType: 'html',
                        data: { product_id : val },
                        success: function(data) {
                            console.log(data);
                            if (data == 1){
                                $('#check-modal').modal('show');
                            } else {
                                $.ajax({
                                    url: '{{route('admin.offers.store',App::getLocale())}}',
                                    type: 'post',
                                    data: $('.create').serialize(),
                                    success: function(data) {
                                        window.location.href = "{{route('admin.offers.index', App::getLocale())}}";
                                    }
                                });
                            }
                        }
                    });
                })
            </script>

        </div>
    </div>

@endsection
