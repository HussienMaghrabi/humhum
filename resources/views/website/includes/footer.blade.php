<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-xs-12">
        <div class="up">
          <img src='{{ asset('storage/assets/website') }}/img/1.png'>
            @php $data =\App\Models\Setting::orderBy('id')->get(); @endphp
              @foreach($data as $item)
                  <p>{{$item['about_'.App::getLocale()]}}</p>
                @endforeach
        </div>
        <!-- up -->
      </div>
      <!-- col -->
      <div class="col-md-3 col-xs-12">
        <div class="up">
          <h1>الشراء من هم هم</h1>
          <ul class="list-unstyled important">
            <li>
              <!-- Button trigger modal -->
              <a class="btn" data-target="#exampleModalCenter" data-toggle="modal">
                الشروط والاحكام
              </a>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" role="dialog" aria-hidden="true" aria-labelledby="exampleModalCenterTitle"
                   tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    @foreach($data as $item)
                    <div class="modal-body">
                      {{$item['term_'.App::getLocale()]}}
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </li>
            <li>

              <!-- Button trigger modal -->
              <a class="btn" data-target="#exampleModalCenter1" data-toggle="modal">
                سياسة الاستخدام
              </a>
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalCenterTitle"
                   tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    @foreach($data as $item)
                    <div class="modal-body">
                      {{$item['privacy_'.App::getLocale()]}}
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">
                مساعدة
              </a>
            </li>
            <li>
              <a href="#">
                ابدا البيع
              </a>
            </li>
            <li>
              <a href="#">
                كيفية البيع
              </a>
            </li>
            <li>
              <a href="{{route('web.policies.index', [App::getLocale()])}}">
                سياسة البيع
              </a>
            </li>
            <li>
              <a href="{{route('web.terms.index', [App::getLocale()])}}">
                شروط واحكام البائع
              </a>
            </li>
            <li>
              <a href="#">
                الاسئلة الشائعة
              </a>
            </li>

          </ul>
        </div>
        <!-- up -->
      </div>
      <!-- col -->
      <div class="col-md-3 col-xs-12">
        <div class="up">
          <h1>حسابى</h1>
          <ul class="list-unstyled important">
            <li>
              <a href="{{ route('web.auth', App::getLocale()) }}">
                تسجيل\دخول
              </a>
            </li>
            <li>
              <a href="{{route('web.cart.index', [App::getLocale()])}}">
                عربة التسوق
              </a>
            </li>
            <li>
              <a href="my-orders.html">
                طلباتى
              </a>
            </li>
            <li>
              <a href="favourite.html">
                المفضلة
              </a>
            </li>
            <li>
              <a href="setting.html">
                اعدادات الحساب
              </a>
            </li>
            <li>
              <a href="myAccount.html">
                حركات حسابى
              </a>
            </li>

          </ul>
        </div>
        <!-- up -->
      </div>
      <!-- col -->
      <div class="col-md-3 col-xs-12">
        <div class="up">
          <h1>تواصل معنا</h1>
          <h6>
            <i class='fa fa-phone'></i>01124269532</h6>
          <ul class="list-unstyled social">
            <li>
              <a href="#" target="_blank">
                <img src='{{ asset('storage/assets/website') }}/img/8.png'>
              </a>
            </li>
            <li>
              <a href="#" target="_blank">
                <img src="{{ asset('storage/assets/website') }}/img/9.png">
              </a>
            </li>
            <li>
              <a href="#" target="_blank">
                <img src="{{ asset('storage/assets/website') }}/img/10.png">
              </a>
            </li>

          </ul>
          <h1>حمل تطبيق هم هم</h1>
          <ul class="list-unstyled social">
            <li>
              <a href="#" target="_blank">
                <img src="{{ asset('storage/assets/website') }}/img/11.png">
              </a>
            </li>
            <li>
              <a href="#" target="_blank">
                <img src="{{ asset('storage/assets/website') }}/img/12.png">
              </a>
            </li>
          </ul>
        </div>
        <!-- up -->
      </div>
      <!-- col -->
    </div>
    <!-- row -->
  </div>
  <!-- container -->
  <div class="copyRight text-center">
    <h2>Powered by
      <a href="#">Valux</a>
    </h2>
  </div>
  <!-- copyRight -->
</footer>