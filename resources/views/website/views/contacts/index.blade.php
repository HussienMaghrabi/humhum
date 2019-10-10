@extends('website.layouts.app')
@section('content')

    <section class='map'>
        <div class='col-md-12'>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.146469557237!2d31.332384284884487!3d30.06133578187617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb2445bd706849efc!2s302Labs+Coworking+Space!5e0!3m2!1sar!2seg!4v1520426354110"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>
    <section class='contact'>
        <div class='container'>
            <div class='col-md-12'>
                <form>
                    <div class="form-group">
                        <input class="form-control" name="name" type="text" placeholder="الأسم">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="number" type="number" placeholder="رقم الموبايل">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="email" type="text" placeholder="البريد الاليكترونى">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="msg" type="text" placeholder="اترك رسالتك" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button class="btn btn-lg" type="submit">ارسال</button>
                </form>
            </div>
        </div>
    </section>

@endsection