<div class="modal fade " id="{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{$url}}" method="post">
        @csrf
        @isset($method)
            @method($method)
        @endisset
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
    </form>
</div>
