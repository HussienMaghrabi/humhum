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
@else
        @foreach($subsubcat as $subsub)
                <option
                        @if(isset($item) &&$subsub->id == $item->sub_sub_category_id)
                        selected
                        @endif
                        value="{{$subsub->id}}"> {{$subsub->name}}
                </option>
        @endforeach

@endif