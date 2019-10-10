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
<label for="desc_ar" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Description_ar")}}</label>
<div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
{!!Form::textarea('desc_ar', null, array( 'id' => 'desc_ar', 'placeholder'=>__('dashboard.Description_ar'), 'class'=>'form-control'))!!}
</div>
</div>

<div class="form-group">
<label for="desc_en" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Description_en")}}</label>
<div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
{!!Form::textarea('desc_en', null, array('required', 'id' => 'desc_en', 'placeholder'=>__('dashboard.Description_en'), 'class'=>'form-control'))!!}
</div>
</div>

<div class="form-group">
    <label for="image" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Image')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('image', array('id' => 'image', 'multiple'=> 'multiple', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>

<div class="form-group">
    <label for="images" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__('dashboard.Images')}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::file('images[]', array('id' => 'image', 'multiple'=> 'multiple', 'class'=>'form-control', isset($item) ? '' : 'required'))!!}
    </div>
</div>

<div class="form-group">
    <label for="category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Categories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="category_id" name="category_id"   class="form-control"  >
            <option selected disabled></option>
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
        <select id="sub_category_id" name="sub_category_id"   class="form-control"  >

        </select>
    </div>
</div>

<div class="form-group">
    <label for="sub_sub_category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Sub2Categories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="sub_sub_category_id" name="sub_sub_category_id" class="form-control" >

        </select>
    </div>
</div>

<script >
    $(function() {
        $('#category_id').on('change', function() {
            var val = $(this).val();
            console.log(val);
            $.ajax({
                url: '{{route('admin.offers.ajax',App::getLocale())}}',
                dataType: 'html',
                data: { category_id : val },
                success: function(data) {
                    console.log(data);
                    $('#sub_sub_category_id').prop('disabled', false);
                    $('#sub_category_id').html(data);
                }
            });
        });

        $('#sub_category_id').on('change', function() {
            var val = $(this).val();
            $.ajax({
                url: '{{route('admin.offers.ajax',App::getLocale())}}',
                data: { sub_category : val },
                success: function(data) {
                    if (data['type'] === 1){
                        console.log(data['type']);
                        $('#product_id').html(data['view']);
                        $('#sub_sub_category_id').prop('disabled', true);
                    } else{
                        console.log(data['type']);
                        $('#sub_sub_category_id').html(data['view']);
                    }
                }
            });
        });
    });

</script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjcfdEkkiorkXtSay38ovotSFNWWK-zsE&libraries=places&callback=initialize" async defer></script>
<script src="{{ asset('storage/assets/map/style.js') }}"></script>

