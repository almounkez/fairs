<div class="card">
    <div class="card-header">{{ __('MailList') }}</div>
    <div class="card-body">
        <form action="{!! route('mailList.store') !!}" method="Post">
            @csrf
            @if(!empty($source_type))
            <input type="hidden" class="form-control" name="source_type" value="{{$source_type}}">
            @endif
            @if(!empty($suiteId))
            <input type="hidden" class="form-control" name="source_id" value={{$suiteId}}>
            @elseif(!empty($fairId))
            <input type="hidden" class="form-control" name="source_id" value={{$fairId}}>
            @endif
            {{-- <div class="form-row"> --}}
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">{{ __('Full Name')}}</label>
                <input type="text" class="col-4 form-control" name="full_name">
                {{-- </div>
                <div class="form-group col-6"> --}}
                <label class="col-2 col-form-label">{{__('Email')}}</label>
                <input type="text" class="col-4 form-control" name="email">
            </div>
            {{-- </div> --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="col-form-label">{{__('Mobile')}}</label>
                    <input type="text" class="form-control" name="code" placeholder="+963">
                    <input type="text" class="form-control" name="mobile" placeholder="989808770">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="country">{{__('Country')}}</label>
                    <input type="text" class="form-control" name="country">
                </div>
                <div class="form-group col-6">
                    <label for="city">{{__('City')}}</label>
                    <input type="text" class="form-control" name="city">
                </div>
            </div>
            <div class="form-group">
                <label for="captcha">{{__('Captcha')}}</label>
                {{-- <div class="form-row"> --}}
                {{-- <div class="col-5"> --}}
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" id="reload">
                        &#x21bb;
                    </button>
                </div>
                {{-- </div> --}}
                {{-- <div class="col-7"> --}}
                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                {{-- </div> --}}
                {{-- </div> --}}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
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
