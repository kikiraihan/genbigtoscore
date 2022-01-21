

<div class="space-y-4">
    <div>
        <div class="font-bold">Role Utama: </div>
        @foreach ($radio as $item)
        <div class="divUtamaRole">
            <input type="radio" id="{{$item->name}}" name="satu" value="{{$item->name}}" @if($user->hasRole($item->name)) checked @endif>
            <label for="{{$item->name}}">{{$item->name}}</label>
        </div>
        @endforeach
    </div>
    
    <div>
        <div class="font-bold">Role Sekunder: </div>
        {{-- harus flat begini --}}
        @foreach ($check as $item)
            <div class="divCheckboxRole"><input type="checkbox" id="{{$item->id}}" name="dua['{{$item->id}}']" value="{{$item->name}}" @if($user->hasRole($item->name)) checked @endif><label for="{{$item->id}}">{{$item->name}}</label></div>
        @endforeach
    </div>
</div>
