<!-- start header -->
<header>
  <nav class="navbar navbar-expand-lg navbar-light ">
    <div class="sidenav" id="mySidenav">
      <h2>الصفحة الرئيسية</h2>
      <a class="closebtn" href="javascript:void(0)" onclick="closeNav()">&times;</a>
      <a href="{{route('web.cart.index', [App::getLocale()])}}">عربه التسوق</a>
      <a href="my-orders.html">طلباتى</a>
      <a href="favourite.html">المفضلة</a>
      <a href="contact.html">تواصل معنا</a>
      <a href="suggestion.html">ارسال مقترح</a>
      <a href="questions.html">الأسئلة الشائعة</a>
      <h2>جميع الأصناف</h2>
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h3 class="mb-0">
              <button class="btn btn-link" data-target="#collapseOne" data-toggle="collapse" type="button" aria-controls="collapseOne"
                      aria-expanded="false">
                خضراوات وفاكهة
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseOne" data-parent="#accordionExample" aria-labelledby="headingOne">
            <div class="card-body">
              <a href='sub-category.html'>طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button" aria-controls="collapseTwo"
                      aria-expanded="false">
                <!-- <span class="glyphicon glyphicon-menu-down "></span> -->
                لحوم
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseTwo" data-parent="#accordionExample" aria-labelledby="headingTwo">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseThree" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                دواجن
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseThree" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseFour" data-toggle="collapse" type="button" aria-controls="collapseFour"
                      aria-expanded="false">
                اسماك
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseFour" data-parent="#accordionExample" aria-labelledby="headingFour">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header" id="headingFive">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseFive" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                مخبوزات وحلويات
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseFive" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header" id="headingSix">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseSix" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                مكسرات
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseSix" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header" id="headingSeven">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseSeven" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                عطارة
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseSeven" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header" id="headingEight">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseEight" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                أدوات منزلية
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseEight" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card">
          <div class="card-header" id="headingNine">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" data-target="#collapseNine" data-toggle="collapse" type="button" aria-controls="collapseThree"
                      aria-expanded="false">
                سوبرماركت
              </button>
            </h3>
          </div>
          <div class="collapse" id="collapseNine" data-parent="#accordionExample" aria-labelledby="headingThree">
            <div class="card-body">
              <a href="sub-category.html">طماطم</a>
              <a href="sub-category.html">خيار</a>
              <a href="sub-category.html">بطاطس</a>
            </div>
          </div>
        </div>
        <!-- card -->
        <h2>المحافظات</h2>
        <a href="#">السويس</a>
        <a href="#">الاسكندرية</a>
        <a href="#">دمياط</a>
        <a href="#">القاهرة</a>
        <h2>اللغة</h2>
        <a href="#">English</a>
      </div>
    </div>
    <span onclick="openNav()" class="navbar-toggler-icon"></span>

    <a class="navbar-brand" href="{{route('web.home', [App::getLocale()])}}">
      <img src='{{ asset('storage/assets/website') }}/img/1.png'>
    </a>
    <div class='parent navMob'>
      <div class='all-input'>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="my-orders.html">طلباتي
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="favourite.html">المفضله</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">تواصل معنا</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="suggestion.html">ارسال مقترح</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="questions.html">الأسئلة الشائعة</a>
            </li>
          </ul>
        </div>
        <form>
          <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01" style='height: 50px;'>
              <option selected="">السعر</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <input class="form-control" type="text" aria-describedby="basic-addon1" aria-label placeholder="طلباتك ايه">
            <div class="input-group-prepend">
              <button class="btn btn-lg" type="button">ابحث</button>
            </div>
          </div>
        </form>

      </div>
      <!-- all-input -->
      <div class='myAccount'>
        <div class="dropdown">
          <button class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" type="button" aria-expanded="false" aria-haspopup="true">
            حسابي
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a  href='{{ route('web.auth', App::getLocale()) }}' class='btn '>دخول</a>
            <h6>هل انت عميل جديد؟
              <a href='{{ route('web.auth', App::getLocale()) }}'>تسجيل</a>
            </h6>
            <h5>تتبع طلبك</h5>
            <form class='text-center'>
              <div class="form-group">
                <label for="exampleInputPassword1">رقم طلبكم</label>
                <input class="form-control" id="exampleInputPassword1" type="number">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">البريد الاليكترونى </label>
                <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp">
              </div>

              <button class='btn btn-block'>تتبع طلبك</button>
            </form>
            <!-- form -->
          </div>
        </div>
        <!-- dropdown -->
        <a class='cartIcon' href='{{route('web.cart.index', [App::getLocale()])}}'>
          <img src="{{ asset('storage/assets/website') }}/img/2.png"> عربه التسوق
        </a>
        @if(App::getLocale() == "ar")
        <a class="lang" href="/en">
          Eng
        </a>
          @else
          <a class="lang" href="/ar">
            Ar
          </a>
        @endif
        <!-- cartIcon -->
      </div>
      <!-- myAccount -->
    </div>
  </nav>
</header>
<!-- end header -->