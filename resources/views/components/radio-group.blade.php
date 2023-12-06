<div>
    @if($allOption)
        <div>
            <label for="{{$name}}">
                <input type="radio" name="{{$name}}" value="" @checked(!request($name) || request($name) === 'all')>
                <span>All</span>
            </label>
        </div>
    @endif

    @if($value !== null)
        @foreach($options as $option)
            <div>
                <label for="experience">
                    <input type="radio" name="{{$name}}" value="{{$option}}" @checked($value)>
                    <span>{{$option}}</span>
                </label>
            </div>
        @endforeach
    @else
        @foreach($options as $option)
            <div>
                <label for="experience">
                    <input type="radio" name="{{$name}}" value="{{$option}}" @checked(request($name) === $option)>
                    <span>{{$option}}</span>
                </label>
            </div>
        @endforeach
    @endif
</div>
