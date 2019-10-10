<select id="sub_category_id" name="sub_category_id" class="form-control" >

        @foreach($subcategories as $categories)
        <option
                @if(isset($item) &&$categories->id == $item->sub_category_id)
                selected
                @endif
                value="{{$categories->id}}"> {{$categories->name}}
        </option>
    @endforeach
</select>