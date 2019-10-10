<!-- start second-nav -->
<section class="second-nav navMob">
  <nav class="navbar navbar-expand-lg navbar-light ">
    <button class="navbar-toggler" data-target="#navbarNav" data-toggle="collapse" type="button" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link " id="navbarDropdownMenuLink" href="{{route('web.categories.index', [App::getLocale()])}}">
            {{__('website.All')}}
          </a>
          <div class="menuDrop" aria-labelledby="navbarDropdownMenuLink">
            <div class="container">
              <div class="row">
                @php $data =\App\Models\Category::orderBy('id')->get(); @endphp
                @foreach($data as $item)
                <div class="col-md-3">
                  <ul class="list-unstyled">
                    <h2>{{$item['name_'.App::getLocale()]}}</h2>
                    <li>
                      <a href="{{route('web.subcategories.show', [App::getLocale(), $item->id])}}">
                        @foreach($item->category as $sub)
                          {{$sub['name_'.App::getLocale()]}}<br>
                        @endforeach</a>
                    </li>
                  </ul>
                </div>
              @endforeach
                <!-- col-3 -->
              </div>
              <!-- row -->
            </div>
          </div>
          <!-- dropdown-menu -->
        </li>
        @foreach($data as $item)
        <li class="nav-item">
          <a class="nav-link" href="{{route('web.subcategories.show', [App::getLocale(), $item->id])}}">{{$item['name_'.App::getLocale()]}}</a>
        </li>
        @endforeach
      </ul>
    </div>
  </nav>
</section>
<!-- end second-nav -->