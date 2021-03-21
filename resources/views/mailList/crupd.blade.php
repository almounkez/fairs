<div class="card">
    {{-- <div class="card-header">{{ __('MailList') }}</div> --}}
<div class="card-body">
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

        <div class="form-group row">
            <div class="col ">
                <input type="text" class="form-control form-control-sm" name="full_name" placeholder="Full Name">
            </div>
            <div class="col ">
                <input type="email" class="form-control form-control-sm" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <div class="col ">
                {{-- <label class="col-md-2  col-sm-3 col-form-label col-form-label-sm" for="country">{{__('Country')}}</label>
                --}}
                <input type="text" class="form-control form-control-sm " name="country" placeholder="country">
            </div>
            <div class="col ">
                {{-- <label class="col   col-form-label col-form-label-sm" for="city">{{__('City')}}</label>
                --}}
                <input type="text" class="form-control form-control-sm " name="city" placeholder="city">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label col-form-label-sm">{{__('Mobile')}}</label>
            <div class="col-4">
                <input type="text" class="form-control form-control-sm " name="mobile" placeholder="+963 989808770">
            </div>
        {{-- </div>
        <div class="form-group row"> --}}

            <div class="col">
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" id="reload">
                        &#x21bb;
                    </button>
                </div>
            {{-- </div>

            <div class="col"> --}}
                <input id="captcha" type="text" class="form-control my-1" placeholder="Enter Captcha"
                    name="captcha">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    </form>
</div>
</div>


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
