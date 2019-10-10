<div class="form-group">
    <label for="vat" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.vat")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('vat', null, array('required', 'id' => 'vat', 'placeholder'=>__('dashboard.vat'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="maximum " class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.maximum")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('maximum', null, array('required', 'id' => 'maximum', 'placeholder'=>__('dashboard.maximum'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="about_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.About_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('about_ar', null, array('required', 'id' => 'about_ar', 'placeholder'=>__('dashboard.About_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="about_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.About_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('about_en', null, array('required', 'id' => 'about_en', 'placeholder'=>__('dashboard.About_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="privacy_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Privacy_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('privacy_ar', null, array('required', 'id' => 'privacy_ar', 'placeholder'=>__('dashboard.Privacy_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="privacy_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Privacy_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('privacy_en', null, array('required', 'id' => 'privacy_en', 'placeholder'=>__('dashboard.Privacy_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="term_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Term_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('term_ar', null, array('required', 'id' => 'term_ar', 'placeholder'=>__('dashboard.Term_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="term_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Term_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('term_en', null, array('required', 'id' => 'term_en', 'placeholder'=>__('dashboard.Term_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="how_to_sell_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.How_to_Sell_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('how_to_sell_ar', null, array('required', 'id' => 'how_to_sell_ar', 'placeholder'=>__('dashboard.How_to_Sell_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="how_to_sell_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.How_to_Sell_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('how_to_sell_en', null, array('required', 'id' => 'how_to_sell_en', 'placeholder'=>__('dashboard.How_to_Sell_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="term_sale_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Term_Sale_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('term_sale_ar', null, array('required', 'id' => 'term_sale_ar', 'placeholder'=>__('dashboard.Term_Sale_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="term_sale_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Term_Sale_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('term_sale_en', null, array('required', 'id' => 'term_sale_en', 'placeholder'=>__('dashboard.Term_Sale_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="sell_policy_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Sell_Policy_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('sell_policy_ar', null, array('required', 'id' => 'sell_policy_ar', 'placeholder'=>__('dashboard.Sell_Policy_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="sell_policy_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Sell_Policy_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::textarea('sell_policy_en', null, array('required', 'id' => 'sell_policy_en', 'placeholder'=>__('dashboard.Sell_Policy_en'), 'class'=>'form-control'))!!}
    </div>
</div>








