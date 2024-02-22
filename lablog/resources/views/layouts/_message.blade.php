<div class="toast-message-box top-0 end-0 position-absolute z-3">
@foreach(['success','warning','danger','primary'] as $flag)
    @if(session()->has($flag))
    <div class="toast fade text-bg-{{$flag}} mt-2 me-2 toast-message" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
             <!-- <img src="..." class="rounded me-2" alt=""> -->
            @if($flag == 'danger')
            <strong class="me-auto">注意</strong>
            @elseif($flag == 'success')
            <strong class="me-auto">成功</strong>
            @elseif($flag == 'warning')
            <strong class="me-auto">警告</strong>
            @elseif($flag == 'primary')
            <strong class="me-auto">通知</strong>
            @endif

            <!-- <small>11 mins ago</small> -->
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{session()->get($flag)}}
        </div>
    </div>
    @endif
@endforeach

</div>

@section('jquery')
console.log('message')
$('.toast-message').addClass('show')
var timer = setTimeout(function () {
        $('.toast-message').removeClass('show')
    },
    3000
)
@endsection
