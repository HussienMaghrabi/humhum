<option selected disabled>{{__('dashboard.choose')}}</option>

        @if(isset($category))
        @foreach($category as $cat)
                <option
                        @if(isset($item) &&$cat->id == $item->sub_category_id)
                        selected
                        @endif
                        value="{{$cat->id}}"> {{$cat->name}}
                </option>
        @endforeach
        @elseif(isset($subsubcat))
        @foreach($subsubcat as $subsub)
        <option
                @if(isset($item) &&$subsub->id == $item->sub_sub_category_id)
                selected
                @endif
                value="{{$subsub->id}}"> {{$subsub->name}}
        </option>
        @endforeach
        @else
        @foreach($products as $product)
        <option
                @if(isset($item) &&$product->id == $item->product_id)
                selected
                @endif
                value="{{$product->id}}"> {{$product->name}}
        </option>
        @endforeach
        @endif