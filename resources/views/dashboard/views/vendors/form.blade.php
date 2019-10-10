<div class="form-group">
  <label for="name_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Name_ar")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('name_ar', null, array('required', 'id' => 'name_ar', 'placeholder'=>__('dashboard.Name_ar'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
  <label for="name_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Name_en")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('name_en', null, array('required', 'id' => 'name_en', 'placeholder'=>__('dashboard.Name_en'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="email" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Email")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::email('email', null, array('required', 'id' => 'email', 'placeholder'=>__('dashboard.Email'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="password" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Password")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::password(  'password', array(isset($item->password) ? '' : 'required', 'id' => 'password', 'placeholder'=>__('dashboard.Password'), 'class'=>'form-control'))!!}  </div>
</div>

<div class="form-group">
    <label for="city_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.City")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::select('city_id', $city, null, array('required', 'id' => 'city_id', 'placeholder'=>__('dashboard.City'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Category")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::select('category_id', $categories, null, array('required', 'id' => 'Category_id', 'placeholder'=>__('dashboard.Category'), 'class'=>'form-control'))!!}
    </div>
</div>






