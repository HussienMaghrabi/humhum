@extends('website.layouts.app')
@section('title', __('website.Login'))

@section('content')

    <section class="register text-center">
        <div class="container">
            <h2>{{ __('website.LoginWelcome') }}</h2>
            <h2>{{ __('website.Or') }}
                <span>{{ __('website.LoginHint') }}</span>
            </h2>
            <div class='row'>
                <div class='col-md-6 col-xs-12'>
                    <h3>{{ __('website.Register') }}</h3>
                    <form action ="{{ route('web.register', App::getLocale()) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="url" value="{{ URL::previous() }}">
                        <div class="input-wrap text">
                            <input class='form-control' id="name" type="text" name="name" value="{{ old('name') }}" required>
                            <label for="name">{{ __('website.Name') }}</label>
                        </div>
                        <div class="input-wrap text">
                            <input class='form-control' id="phone" type="text" name="phone" value="{{ old('phone') }}" required>
                            <label for="phone">{{ __('website.Phone') }}</label>
                        </div>
                        <div class="input-wrap text">
                            <input class="form-control" id="email" type="text" name="email" value="{{ old('email') }}" required>
                            <label for="email">{{ __('website.Email') }}</label>
                        </div>
                        <div class="input-wrap text">
                            <input class="form-control" id="password" type="password" name="password" required>
                            <label for="password">{{ __('website.Password') }}</label>
                        </div>
                        <div class="input-wrap text">
                            <input class="form-control" id="password" type="password" name="password_confirmation" required>
                            <label for="password">{{ __('website.ConfirmPassword') }}</label>
                        </div>
                        <div class="form-check text-right">
                            <input class="form-check-input" id="exampleCheck1" type="checkbox" name="remember" required>
                            <label class="form-check-label" for="exampleCheck1">
                                {{ __('website.IAgreeOn') }}
                                <a class='' href="#"></a>
                                <!-- Button trigger modal -->
                                <a class="condition" data-target="#exampleModalCenter" data-toggle="modal" href="#">
                                    {{ __('website.PrivacyPolicy') }}
                                </a>

                                <!-- Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" role="dialog" aria-hidden="true" aria-labelledby="exampleModalCenterTitle"
                                     tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('website.PrivacyPolicy') }}</h5>
                                                <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                {{ \App\Models\Setting::select("privacy_".App::getLocale()." as privacy")->first()->privacy }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <input class='btn' value="{{ __('website.Register') }}" type="submit">
                    </form>
                </div>


                <!-- col -->
                <div class="col-md-6 col-xs-12 ">
                    <h3>{{ __('website.Login') }}</h3>
                    <form class='login' action="{{ route('web.auth', App::getLocale()) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="url" value="{{ URL::previous() }}">
                        <div class="input-wrap text">
                            <input class="form-control" id="email" type="text" name="email" required>
                            <label for="email">{{ __('website.EmailOrPhone') }}</label>
                        </div>
                        <div class="input-wrap text">
                            <input class="form-control" id="password" type="password" name="password" required>
                            <label for="password">{{ __('website.Password') }}</label>
                        </div>
                        <div class="form-check text-right">
                            <!-- Button trigger modal -->
                            <a class="forget pull-left" data-target="#exampleModalCenter2" data-toggle="modal">
                                {{ __('website.ForgetPassword') }}
                            </a>
                        </div>
                        <button class="btn">{{ __('website.Login') }}</button>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter2" role="dialog" aria-hidden="true" aria-labelledby="exampleModalCenterTitle"
                         tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('website.forget_password') }}</h5>
                                    <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="input-wrap text">
                                            <input class="form-control" id="password" type="email" name="email" required>
                                            <label for="password">{{ __('website.email') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="btn btn-primary" type="submit" value="{{ __('website.send') }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a class="" href="#"></a>

                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!-- end register -->

@endsection