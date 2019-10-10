<div class="form-group">
  <label for="question_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.question_ar")}}</label>
  <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
    {!!Form::text('question_ar', null, array('required', 'id' => 'question_ar', 'placeholder'=>__('dashboard.question_ar'), 'class'=>'form-control'))!!}
  </div>
</div>

<div class="form-group">
    <label for="question_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.question_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('question_en', null, array('required', 'id' => 'question_en', 'placeholder'=>__('dashboard.question_en'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="answer_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.answer_ar")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('answer_ar', null, array('required', 'id' => 'answer_ar', 'placeholder'=>__('dashboard.answer_ar'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="answer_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.answer_en")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::text('answer_en', null, array('required', 'id' => 'answer_en', 'placeholder'=>__('dashboard.answer_en'), 'class'=>'form-control'))!!}
    </div>
</div>

