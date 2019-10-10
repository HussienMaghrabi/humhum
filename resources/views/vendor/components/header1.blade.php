<section class="content-header">
    <h1>
        <small>
            {{ '.' }}
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href=" {{ route('vendor.home', App::getLocale()) }} ">
                <i class="fa fa-{{$resource['icon']}}"></i>
                {{__('dashboard.Home')}}
            </a>
        </li>

        @foreach ($headers as $item => $route)
            @if($loop->last)
                <li class="active">{{$item}}</li>
            @else
                <li>
                    <a href=" {{ $route }} ">
                        {{$item}}
                    </a>
                </li>
            @endif
        @endforeach

    </ol>
</section>
