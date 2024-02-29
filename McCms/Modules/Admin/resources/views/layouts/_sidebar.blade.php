<div class="bsa-sidebar">
    <!--  侧边栏头部部分(展示品牌logo)  -->
    <div class="bsa-sidebar-header">
        <img src="/dist/img/favicon-32x32.png" class="bsa-logo-icon" alt="logo-icon">
        <div class="bsa-logo-text ms-2 bsa-ellipsis-2">{{config('app.name')}}</div>
    </div>
    <!--  侧边栏的身体部分  -->
    <div class="bsa-sidebar-body" data-overlayscrollbars-initialize>
        <!--   侧边栏的菜单     -->
        <ul class="bsa-menu" data-bsa-toggle="sidebar" data-accordion="true" data-click-close="true">
            <li>
                <a href="{{route('admin.home')}}">
                    <i class="bi bi-house"></i>首页
                </a>
            </li>

            <li>
                <a href="javascript:" class="has-children">
                    <i class="bi bi-filetype-html"></i>库存管理
                </a>
                <ul>
                    <li>
                        <a href="pages/layout1.html">产品</a>
                    </li>
                    <li>
                        <a href="pages/layout2.html">配件</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:" class="has-children">
                    <i class="bi bi-filetype-html"></i>库存设置
                </a>
                <ul>
                    <li>
                        <a href="pages/layout1.html">产品</a>
                    </li>
                    <li>
                        <a href="pages/layout2.html">配件</a>
                    </li>
                </ul>
            </li>



            <li>
                <a href="javascript:" class="has-children">
                    <i class="bi bi-person-lock"></i>权限管理
                </a>
                <ul>
                    <li>
                        <a href="pages/user.html">用户列表</a>
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
</div>
