<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        ادارة المعرض
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('fair.index') }}">
            قائمة المعارض
        </a>
        <a class="dropdown-item" href="{{ route('fair.create') }}">
            @lang('New Fair')</a>

        @if(!empty($fairId)||!empty($fair))
        <a class="dropdown-item" href="{{ route('fair.suites',$fairId ?? $fair->id) }}">
            @lang('Suites')</a>
        <a class="dropdown-item" href="{{ route('fair.categories',$fairId ?? $fair->id) }}">
            @lang('Categories')</a>
        <a class="dropdown-item" href="{{ route('fair.slides',$fairId ?? $fair->id) }}">
            @lang('Slides')</a>
        @endif
    </div>
</li>
