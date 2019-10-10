<!-- start slider -->
<section class='slider'>
    <div class='container'>

        <div class='col-md-12 col-xs-12'>
            <div class="carousel slide" id="carouselExampleControls" data-ride="carousel">
                <div class="carousel-inner">
                    @php $item = \App\Models\Banner::select("image")->get(); $f = 1;@endphp
                    @foreach($item as $data)
                    <div class="carousel-item @if($f == 1)active @endif ">
                        @php $f=2; @endphp
                        <img class="d-block w-100" src="{{$data->image}}" alt="First slide">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" data-slide="prev" href="#carouselExampleControls" role="button">
                    <span class="fa fa-angle-left prev" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" data-slide="next" href="#carouselExampleControls" role="button">
                    <span class="fa fa-angle-right next" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>
</section>
<!-- end slider -->