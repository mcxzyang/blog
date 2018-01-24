@inject('menus','App\Services\MenuService')
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                {{--<li class="menu-title">Navigation</li>--}}

                @foreach($menus->getMenu() as $menu)
                    @menu($menu)
                        <li @if($menu->childmenus->count()) class="has_sub" @endif>
                            <a href="{{ linker($menu->name) }}" class="waves-effect @if($menus->checkActive($menu)) active @endif @if($menu->childmenus->count() && $menus->checkFirstMenu($menu)) subdrop @endif"><i class="{{ $menu->icon }}"></i> <span> {{ $menu->display_name }} </span> @if($menu->childmenus->count())<span class="menu-arrow"></span>@endif</a>
                            @if($menu->childmenus->count())
                            <ul class="list-unstyled" @if($menus->checkFirstMenu($menu)) style="display: block" @endif>
                                @foreach($menu->childmenus as $child)
                                        @menu($child)
                                            <li @if($menus->checkParent($child)) class="active" @endif><a href="{{ linker($child->name) }}" @if($menus->checkParent($child)) class="active" @endif>{{ $child->display_name }}</a></li>
                                        @endmenu
                                    @endforeach
                            </ul>
                                @endif
                        </li>
                    @endmenu
                    @endforeach


            </ul>
        </div>

    </div>
    <!-- Sidebar -left -->

</div>
