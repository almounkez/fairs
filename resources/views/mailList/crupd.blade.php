<form action="{!! route('mailList.store') !!}" method="Post">
    @csrf
    @if(!empty($source_type))
    <input type="hidden" name="source_type" value="{{$source_type}}">
    @endif
    @if(!empty($suiteId))
    <input type="hidden" name="source_id" value={{$suiteId}}>
    @elseif(!empty($fairId))
    <input type="hidden" name="source_id" value={{$fairId}}>
    @endif

    <div class="form-group row m-0">
        <div class="col p-1">
            <input type="text" class="form-control form-control-sm" name="full_name" placeholder="Full Name" required>
        </div>
        <div class="col p-1">
            <input type="email" class="form-control form-control-sm" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row m-0">
        <div class="col-6 p-1">
            <input type="text" class="form-control form-control-sm " name="country" placeholder="country" required>
        </div>
        <div class="col-6 p-1">
            <input type="text" class="form-control form-control-sm " name="city" placeholder="city" required>
        </div>
    </div>
    <div class="form-group row m-0">
        <label class="col-3 p-1">{{__('Mobile')}}</label>
        <div class="col-3 p-1">
            <input type="text" class="form-control form-control-sm " name="code" placeholder="+963">
        </div>
        <div class="col p-1">
            <input type="text" class="form-control form-control-sm " name="mobile" placeholder="989808770">
        </div>
    </div>
    <div class="form-group row m-0">
        <label class="col-3 p-1">{{__('Capatcha')}}</label>
        <div class="col-7 p-1">
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
            </div>
        </div>
        {{-- <div class="col-2 p-1"> --}}
        <button type="button" class="col-2 p-1 my-1 btn btn-outline-light" id="reload">
            &#x21bb;
        </button>
        {{-- </div> --}}
        <div class="col-3 p-1"></div>
        <div class="col-6 p-1">
            <input id="captcha" type="text" class="form-control form-control-sm" placeholder="Enter Captcha"
                name="captcha" required>
        </div>
        {{-- <div class="col-3 p-1"> --}}
            <button type="submit" class="btn btn-outline-light btn-sm col-3 p-1 my-1">{{__('subscribe')}}</button>
        {{-- </div> --}}
    </div>
</form>




@section('script')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){
    $('#reload').click(function () {
        console.log('hhh');
        $.ajax({
            type: 'GET',
            url:"{{route('mailList.recap')}}",
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
    });
</script>
@endsection
