@extends('website.layouts.app')
@section('title', __('website.Cart'))


@section('content')


    <!-- start cart -->
    <section class="cart">
        <div class="container">
            @if($items->count() > 0)
            @foreach($items as $item)
                <div class="row" id="item{{ $item->id }}">
                <div class="col-md-3 col-xs-12 ">
                    <i class='fa fa-trash trash {{ $item->id }}'></i>
                    <img class='imgproduct' src='{{$item->product_image}}'>
                    <div class="counter">
                        <button class="btn add fa fa-plus plus{{ $item->id }}"  id="counter"> </button>
                        <!-- item.quantity -->
                        <span class="quantity{{$item->id}}" id="count">{{ $item->quantity }}</span>
                        <button class="btn remove fa fa-minus minus{{$item->id}}"  id="counter">
                        </button>
                    </div>
                    <!-- counter -->
                </div>
                <!-- col -->
                <div class="col-md-4">
                    <div class="up">
                        <h6>{{$item->product_name}}</h6>
                        <form>
                            <div class="form-group">
                                <label for="exampleInputOrder1">{{__('website.SpecialOrder') }}
                                    <span>({{__('website.Optional')}})</span>
                                </label>
                                <input class="form-control" value="{{$item->text}}" id="text-{{$item->id}}" type="text" placeholder="{{__('website.WriteYourOrderHere')}}">
                            </div>
                        </form>
                        <p>{{__('website.vendor').' : '.$item->Product->vendor['name_'.App::getLocale()] }}</p>
                        <h5>{{ $item->price.' '.__('website.Ryal') }}</h5>
                    </div>
                    <!-- up -->
                </div>
                <!-- col -->
            </div>
            @endforeach
                @else
                <div class="text-center">
                <h3>{{__('website.noCart')}} <a href="/ar">{{__('website.shopping')}}</a></h3>

                </div>
            @endif

        </div>
        <!-- container -->
    </section>

    @if($items->count() > 0)
        <!-- start totalPrice -->
    <section class='price text-center'>
        <h3>{{ __('website.Total') }}</h3>
        <h4>{{ $total.' '.__('website.Ryal') }}</h4>
    </section>

    <!-- totalPrice -->
    <div class="containue text-center">
        <a class="btn btn-lg" href="{{route('web.confirm-address.index', [App::getLocale()])}}">{{ __('website.OrderNow') }}</a>
    </div>
    <!-- end cart -->
    @endif
@endsection
@section('scripts')
    <script>
        @foreach($items as $item)

        $('.plus{{$item->id}}').on('click', function (e) {
            e.preventDefault();

            @if(! Auth::guard('web')->check())
            location.reload();
            window.location.href = "{{route('web.auth', App::getLocale())}}";
                    @endif

            var counter = parseInt($('.quantity{{$item->id}}').text());
            $.ajax({
                url: '{{ route('web.increaseQuantity', [App::getLocale(), $item->id]) }}',
                type: 'get',
                data: {text: $('#text-{{$item->id}}').val()},
                success: function (data) {
                    $('.quantity{{$item->id}}').text(counter + 1);
                    $('.subTotal').text(data['sub_total'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.vat').text(data['vat'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.total').text(data['total'] + ' ' + '{{ __('website.Ryal') }}');
                },
                complete: function () {
                    document.body.className = "";
                }
            });
        });

        $('.minus{{$item->id}}').on('click', function (e) {
            e.preventDefault();

            @if(! Auth::guard('web')->check())
            location.reload();
            window.location.href = "{{route('web.auth', App::getLocale())}}";
                    @endif

            var counter = parseInt($('.quantity{{$item->id}}').text());
            if (counter == 1){return}

            $.ajax({
                url: '{{ route('web.decreaseQuantity', [App::getLocale(), $item->id]) }}',
                type: 'get',
                data: {text: $('#text-{{$item->id}}').val()},
                success: function (data) {
                    $('.quantity{{$item->id}}').text(counter - 1);
                    $('.subTotal').text(data['sub_total'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.vat').text(data['vat'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.total').text(data['total'] + ' ' + '{{ __('website.Ryal') }}');
                },
                complete: function () {
                    document.body.className = "";
                }
            });
        });

        $('.delete{{$item->id}}').on('click', function (e) {
            e.preventDefault();


            @if(! Auth::guard('web')->check())
            location.reload();
            window.location.href = "{{route('web.auth', App::getLocale())}}";
            @endif

                document.body.className = "loading";
            $.ajax({
                url: '{{ route('web.deleteCartItem', [App::getLocale(), $item->id]) }}',
                type: 'get',
                success: function (data) {
                    if(data['sub_total'] == 0)
                    {
                        document.getElementById('priceSection').remove();
                        document.getElementById('continueButton').remove();
                    }

                    $('.subTotal').text(data['sub_total'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.vat').text(data['vat'] + ' ' + '{{ __('website.Ryal') }}');
                    $('.total').text(data['total'] + ' ' + '{{ __('website.Ryal') }}');
                    document.getElementById('item{{$item->id}}').remove();
                },
                complete: function () {
                    document.body.className = "";
                }
            });
        });
        @endforeach
    </script>
@endsection