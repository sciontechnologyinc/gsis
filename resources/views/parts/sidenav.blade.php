<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <div class="footer-side" style="text-align:center;">
            <img class="center-block my-4" src="{{ asset('/storage/school_images/logo.gif') }}" width="120px" height="120px"  />
        </div>
        @if(isset($pages) && count($pages) > 0)
            <ul class="nav flex-column">
                @foreach($pages as $page => $details)
                    @if($details[2] == "False" || Auth::user()->isAdmin == "True")
                    <li class="nav-item">
                        <a class="nav-link @if($page == explode('.', $view_name)[1]){{"active"}}@endif" href="/{{$page}}">
                            <span data-feather="{{$details[1]}}"></span>
                            {{$details[0]}}
                        </a>
                        @if($page == "classes" && isset($classes))
                            <ul class="nav flex-column">
                                @foreach($classes as $class)
                                    <li class="nav-item ml-3">
                                        <a class="nav-link @if(isset($active_class) && $class->id == $active_class){{"active"}}@endif" href="/classes/{{$class->id}}">
                                        {{$class->classname}}
                                    </a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</nav>
