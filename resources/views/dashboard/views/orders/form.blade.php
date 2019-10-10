
<div class="form-group">
    <label for="status_id" class="{{App::getLocale() == 'ar' ? 'col-md-push-10' : ''}} col-sm-2 control-label">{{__("dashboard.Status")}}</label>
    <div class="{{App::getLocale() == 'ar' ? 'col-md-pull-2' : ''}} col-sm-10">
        <select id="status_id" name="status_id"   class="form-control"  >
            <option selected disabled></option>
            @foreach($status as $statu)
                <option
                        @if(isset($item) &&$statu->id == $item->status_id)
                        selected
                        @endif
                        value="{{$statu->id}}"> {{$statu->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>