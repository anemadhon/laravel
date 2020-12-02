<nav class="nav flex-column">
    @foreach ($lists as $list)
        <a class="nav-link {{$isActive($list['label']) ? 'active' : ''}}" href="{{route($list['route'])}}"><i class="icon-menu {{$list['icon']}}"></i>
            {{ $list['label'] }}
        </a>
    @endforeach
</nav>