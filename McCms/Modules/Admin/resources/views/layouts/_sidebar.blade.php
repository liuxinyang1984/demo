<div class="bsa-sidebar row">
    <!--  侧边栏头部部分(展示品牌logo)  -->
    <div class="bsa-sidebar-header">
        <img src="/dist/img/favicon-32x32.png" class="bsa-logo-icon" alt="logo-icon">
        <div class="bsa-logo-text ms-2 bsa-ellipsis-2">{{config('app.name')}}</div>
    </div>
    <!--  侧边栏的身体部分  -->
    <div class="bsa-sidebar-body" data-overlayscrollbars-initialize>
        <!--   侧边栏的菜单     -->
        <ul class="bsa-menu" data-bsa-toggle="sidebar" data-accordion="true" data-click-close="true">
            @foreach($menus as $menu)
            <li>
                @if(isset($menu['menus']))
                <a href="javascript:" class="has-children">
                    <i class="{{$menu['icon']}}"></i>{{$menu['title']}}
                </a>
                <ul>
                    @foreach($menu['menus'] as $subMenu)
                    <li>
                        <a href="{{$subMenu['url']}}">
                            @if(isset($subMenu['icon']))
                            <i class="{{$subMenu['icon']}}"></i>
                            @endif
                            {{$subMenu['title']}}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @else
                <a href="{{$menu['url']}}">
                    <i class="{{$menu['icon']}}"></i>{{$menu['title']}}
                </a>
                @endif
            </li>
            @endforeach

            <li>
                <a href="javascript:" class="has-children">
                    <i class="bi bi-person-lock"></i>权限管理
                </a>
                <ul>
                    <li>
                        <a href="/admin/role">权限列表</a>
                    </li>
                    <li>
                        <a href="pages/user2">用户列表(多部门版)</a>
                    </li>
                    <li>
                        <a href="pages/role.html">角色列表</a>
                    </li>
                    <li>
                        <a href="pages/node.html">节点列表</a>
                    </li>
                </ul>
            </li>



            <li>
                <a href="javascript:" class="has-children">
                    <i class="bi bi-gear"></i>设置
                </a>
                <ul>
                    <li><a href="pages/sys_website.html">网站设置</a></li>
                    <li><a href="pages/sys_email.html">邮件服务</a></li>
                </ul>
            </li>


        </ul>
    </div>
    <div class="col align-self-end text-center">
        <small>Powerby&nbsp;&nbsp;<a href="https://www.imcookie.cn">Mr.Cookie</a></small>
    </div>
</div>
