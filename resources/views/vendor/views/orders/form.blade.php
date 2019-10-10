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
    <label for="price_before" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.price before")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('price_before', null, array('required', 'id' => 'price_before', 'placeholder'=>__('dashboard.price before'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="price_after" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.price after")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('price_after', null, array('required', 'id' => 'price_after', 'placeholder'=>__('dashboard.price after'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="city_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Cities")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::select('city_id', $city, null, array('required', 'id' => 'city_id', 'placeholder'=>__('dashboard.Cities'), 'class'=>'form-control'))!!}
    </div>
</div>

<div class="form-group">
    <label for="sub_category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.SubCategories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="sub_category_id" name="sub_category_id"   class="form-control"  >
            <option>
                {{('')==('Choose Categories')}}

            </option>
            @foreach($subcat as $sub)
                <option
                        @if(isset($item) &&$sub->id == $item->sub_category_id)
                        selected
                        @endif
                        value="{{$sub->id}}"> {{$sub->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="sub_sub_category_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Sub2Categories")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="sub_sub_category_id" name="sub_sub_category_id" class="form-control" >
            <option>
                {{('')==('Choose Categories')}}

            </option>
            @foreach($subsubcat as $subsub)
                <option
                        @if(isset($item) &&$subsub->id == $item->sub_sub_category_id)
                        selected
                        @endif
                        value="{{$subsub->id}}"> {{$subsub->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<script >
    $(function() {
        $('#sub_category_id').on('change', function() {
            var val = $(this).val();
            $.ajax({
                url: '{{route('vendor.products.ajax',App::getLocale())}}',
                dataType: 'html',
                data: { sub_category : val },
                success: function(data) {
                    $('#sub_sub_category_id').replaceWith(data);
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjcfdEkkiorkXtSay38ovotSFNWWK-zsE&libraries=places&callback=initialize" async defer></script>
<script src="{{ asset('storage/assets/map/style.js') }}"></script>

