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
@if(count($errors))
    @foreach($errors->all() as $error)
        <script>
        $.toasts({
            type: 'warning',
            content: '{{$error}}',
            onHidden: function () {
            }
        })
    </script>
    @endforeach
@endif
