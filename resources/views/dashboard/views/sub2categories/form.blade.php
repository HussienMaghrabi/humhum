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
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'multiple'=> 'multiple', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>

<div class="form-group">
    <label for="sort" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Sort")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('sort', null, array('required', 'id' => 'sort', 'placeholder'=>__('dashboard.Sort'), 'class'=>'form-control'))!!}
    </div>
</div>


<div class="form-group">
    <label for="category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Categories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="category_id" name="category_id"   class="form-control"  >
            <option>
                {{('')==('Choose Categories')}}

            </option>
            @foreach($categories as $category)
                <option
                        @if(isset($item) &&$category->id == $item->category_id)
                        selected
                        @endif
                        value="{{$category->id}}"> {{$category->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="sub_category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.SubCategories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="sub_category_id" name="sub_category_id" class="form-control" >
            <option>
                {{('')==('Choose Categories')}}

            </option>
            @foreach($subcategories as $categories)
                <option
                        @if(isset($item) &&$categories->id == $item->sub_category_id)
                        selected
                        @endif
                        value="{{$categories->id}}"> {{$categories->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<script >
    $(function() {
        $('#category_id').on('change', function () {
            var val = $(this).val();
            console.log(val);
            $.ajax({
                url: '{{route('admin.sub2categories.ajax',App::getLocale())}}',
                dataType: 'html',
                data: {category_id: val},
                success: function (data) {
                    $('#sub_category_id').html(data);
                }
            });
        });
    });
</script>