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
    <label for="quantity" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.quantity")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        {!!Form::number('quantity', null, array('required', 'id' => 'quantity', 'placeholder'=>__('dashboard.quantity'), 'class'=>'form-control'))!!}
    </div>
</div>


@if(!isset($item))

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

    <div class="form-group">
        <label for="product_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Product")}}</label>
        <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
            <select id="product_id" name="product_id" class="form-control" >

            </select>
        </div>
    </div>


    <script >
        $(function() {
            $('#category_id').on('change', function() {
                var val = $(this).val();
                console.log(val);
                $.ajax({
                    url: '{{route('vendor.price.ajax',App::getLocale())}}',
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
                    url: '{{route('vendor.price.ajax',App::getLocale())}}',
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

            $('#sub_sub_category_id').on('change', function() {
                var val = $(this).val();
                console.log(val);
                $.ajax({
                    url: '{{route('vendor.price.ajax',App::getLocale())}}',
                    dataType: 'html',
                    data: { sub_sub_category : val },
                    success: function(data) {
                        console.log(data);
                        $('#product_id').html(data);
                    }
                });
            });
        });
    </script>
@endif