
<div class="form-group">
  <label for="password" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Password")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::password('password', array(isset($item->password) ? '' : 'required', 'id' => 'password', 'placeholder'=>__('dashboard.Password'), 'class'=>'form-control'))!!}
  </div>
</div>
