<ul class="bsa-header">
  <!-- 侧边栏触发按钮(移动端时显示) -->
  <li class="bsa-sidebar-toggler" data-bsa-toggle="pushmenu">
    <div class="bsa-header-item">
      <i class="bi bi-list"></i>
    </div>
  </li>
  <!--  搜索组件(不需要可删除)  -->
  <li>
    <div class="bsa-header-item bsa-cursor-default">
      <!--    搜索表单包裹区域        -->
      <div class="bsa-search-form-wrapper"
           data-bsa-toggle="navbar-search"
           data-close-reset="false"
           data-action="pages/search.html"
           data-params='{"type":"article","user":"admin2"}'>
        <div class="bsa-search-form">
          <input type="text" class="form-control bsa-input-search" aria-label="搜索关键词"
                 placeholder="搜索关键词">
          <button class="bsa-search-submit-btn" type="submit"><i class="bi bi-search"></i></button>
          <button class="bsa-search-close-btn" type="button"><i class="bi bi-x-lg"></i></button>
        </div>
      </div>
      <!--    移动端搜索表单触发器(移动端会显示)        -->
      <i class="bi bi-search bsa-search-form-toggler bsa-cursor-pointer"></i>
    </div>
  </li>
  <!--  占位(可以让后面的li居右)  -->
  <li class="flex-grow-1"></li>
  <!--  通知(如果有新消息则添加类名.bsa-has-msg)  -->
  <li>
    <div class="bsa-header-item" data-qt-tab='{"title":"消息中心","url":"#"}'
         data-qt-target=".qtab">
      <i class="bi bi-bell bsa-has-msg"></i>
    </div>
  </li>
  <!--  拓展菜单(建议把拓展放在此处,以免破坏头部整体布局,不需要可以直接删除)  -->
  <li class="dropdown">
    <div class="bsa-header-item" data-bs-toggle="dropdown" data-bs-auto-close="outside">
      <i class="bi bi-grid"></i>
    </div>
    <div class="dropdown-menu dropdown-menu-end p-0">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between bg-body">
          <span class="bsa-fs-15">拓展菜单</span>
          <a href="javascript:" class="bsa-fs-13 text-decoration-none text-body-secondary">编辑</a>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row row-cols-3 g-3">
              <a class="col text-decoration-none text-body-secondary d-flex flex-column align-items-center p-2 gap-1"
                 href="javascript:">
                <div
                  class="d-flex align-items-center justify-content-center bsa-fs-25 bg-body-secondary  bsa-wh-45 rounded-circle">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="bsa-fs-14 bsa-ellipsis-2 text-center">邮箱</div>
              </a>

              <a class="col text-decoration-none text-body-secondary d-flex flex-column align-items-center p-2 gap-1"
                 href="pages/lockscreen.html">
                <div
                  class="d-flex align-items-center justify-content-center bsa-fs-25 bg-body-secondary bsa-wh-45 rounded-circle">
                  <i class="bi bi-lock"></i>
                </div>
                <div class="bsa-fs-14 bsa-ellipsis-2 text-center">锁屏</div>
              </a>

              <a
                class="col text-decoration-none text-body-secondary d-flex flex-column align-items-center p-2 gap-1"
                href="javascript:">
                <div
                  class="d-flex align-items-center justify-content-center bsa-fs-25 bg-body-secondary bsa-wh-45 rounded-circle">
                  <i class="bi bi-link"></i>
                </div>
                <div class="bsa-fs-14 bsa-ellipsis-2 text-center">前台直达</div>
              </a>

            </div>
          </div>
        </div>
        <div class="card-footer text-center bg-body">
          <a href="javascript:" class="bsa-fs-14 text-decoration-none text-body-secondary">查看更多菜单</a>
        </div>
      </div>
    </div>
  </li>
  <!--  全屏  -->
  <li class="bsa-fullscreen-toggler">
    <div class="bsa-header-item">
      <i class="bi bi-arrows-fullscreen"></i>
    </div>
  </li>
  <!--  主题配色  -->
  <li class="dropdown">
    <div class="bsa-header-item" data-bs-toggle="dropdown" data-bs-auto-close="outside">
      <i class="bi bi-palette"></i>
    </div>
    <div class="dropdown-menu dropdown-menu-end p-0">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between bg-body">
          <span class="bsa-fs-15">主题配色</span>
        </div>
        <div class="card-body">
          <!--    配色包裹      -->
          <div class="bsa-theme-switcher-wrapper">
            <input class="form-check-input" type="checkbox" value="light">
            <input class="form-check-input" type="checkbox" value="dark">
            <input class="form-check-input" type="checkbox" value="indigo">
            <input class="form-check-input" type="checkbox" value="green">
            <input class="form-check-input" type="checkbox" value="blue">
            <input class="form-check-input" type="checkbox" value="yellow">
            <input class="form-check-input" type="checkbox" value="pink">
            <input class="form-check-input" type="checkbox" value="red">
            <input class="form-check-input" type="checkbox" value="orange">
            <input class="form-check-input" type="checkbox" value="cyan">
            <input class="form-check-input" type="checkbox" value="teal">
          </div>
        </div>
      </div>
    </div>
  </li>
  <!--    管理员信息    -->
  <li class="dropdown">
    <div class="bsa-header-item" data-bs-toggle="dropdown">
      <div class="bsa-user-area">
        <img src="/dist/img/avatar.jpg" class="bsa-user-avatar" alt="用户头像">
        <div class="bsa-user-details">
          <div class="bsa-ellipsis-1 bsa-fs-15">欲饮琵琶码上催</div>
          <!-- 管理员角色RBAC权限设计时可用(不需要可删除,上面的用户名可自动垂直居中)  -->
          <div class="bsa-ellipsis-1 bsa-fs-13 text-muted">超级管理员</div>
        </div>
      </div>
    </div>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="javascript:"
           data-qt-tab='{"title":"个人资料","url":"pages/profile.html"}'
           data-qt-target=".qtab">
          <i class="bi bi-person me-2"></i>个人资料
        </a>
      </li>
      <li>
        <a class="dropdown-item bsa-clear-cache" href="javascript:"
           data-qt-tab='{"title":"修改密码","url":"pages/password.html"}'
           data-qt-target=".qtab">
          <i class="bi bi-key me-2"></i>修改密码
        </a>
      </li>
      <li>
        <div class="dropdown-divider"></div>
      </li>
      <li class="bsa-logout"><a class="dropdown-item" href="javascript:"><i
        class="bi bi-box-arrow-right me-2"></i>退出登录</a>
      </li>
    </ul>
  </li>
</ul>
