@extends('website.layouts.app')
@section('content')

    <!-- start payment -->
    <section class="payment">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="parent">
                        <div class="method">
                            <h5><img src="{{ asset('storage/assets/website') }}/img/22.png">طريقة الدفع</h5>
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <img src='{{ asset('storage/assets/website') }}/img/24.png'>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <img src='{{ asset('storage/assets/website') }}/img/25.png'>
                                </div>
                            </form>
                        </div>
                        <!-- method -->
                        <div class="row text-center totaly">
                            <div class="col-md-6 col-xs-6">
                                <h4>اجمالى المبلغ</h4>
                                <h6>6000</h6>
                            </div>
                            <!-- col-6 -->
                            <div class="col-md-6 col-xs-6">
                                <h4>تكلفه التوصيل</h4>
                                <h6>200</h6>
                            </div>
                            <!-- col-6 -->
                        </div>
                        <!-- row2 -->
                        <div class="text-center all-price">
                            <h4>المبلغ الكلى</h4>
                            <h6>6200</h6>
                        </div>
                        <!-- all-price -->
                    </div>
                    <!-- parent -->
                    <div class="parent">
                        <div class="method">
                            <h5>
                                <img src="{{ asset('storage/assets/website') }}/img/21.png">تفاصيل العنوان</h5>
                            <a href="confirm-address.html">تغيير العنوان</a>
                        </div>
                        <!-- method -->
                        <ul class="list-unstyled">
                            <li>احمد محمد</li>
                            <li>01124269532</li>
                            <li>Yahia ahmed@gmail.com</li>
                        </ul>
                    </div>
                    <!-- parent -->
                    <button class="btn btn-lg text-center confirmOrder">
                        <div> تأكيد الطلب</div>
                    </button>
                </div>
                <!-- col -->
                <div class="col-md-4 col-xs-12">
                    <div class="parent">
                        <div class="method">
                            <h5>تفاصيل الطلب</h5>
                        </div>
                        <!-- method -->
                        <div class="comment">
                            <img src="{{ asset('storage/assets/website') }}/img/13.jpg">
                            <div class="name">
                                <h5>طماطم</h5>
                                <h6>الكميه :
                                    <span>2</span>
                                </h6>
                                <h6>اجمالى المبلغ :
                                    <span>6200</span>
                                </h6>
                            </div>
                            <!-- name -->
                        </div>
                        <!-- comment -->
                        <div class="total">
                            <h6>اجمالى المبلغ :
                                <span>6000</span>
                            </h6>
                            <h6>تكلفة التوصيل :
                                <span>200</span>
                            </h6>
                            <h6 class="text-center delivery">المبلغ الكلى :
                                <span>6200</span>
                            </h6>
                        </div>
                    </div>
                    <!-- parent -->
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end payment -->

@endsection