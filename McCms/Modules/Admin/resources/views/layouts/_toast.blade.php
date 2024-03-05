@foreach(['success','warning','danger','primary'] as $flag)
    @if(session()->has($flag))
    <script>
    $.toasts({
        type: '{{$flag}}',
        content: '{{session()->get($flag)}}',
        onHidden: function () {
        }
    })
    </script>
    @endif
@endforeach
