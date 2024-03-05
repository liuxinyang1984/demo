@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

<link rel="stylesheet" href="/lib/bootstrap-table/dist/bootstrap-table.min.css">
<link rel="stylesheet" href="/lib/bootstrap-table/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.css">
<link rel="stylesheet" href="/lib/@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css"/>
<link rel="stylesheet" href="/lib/bootstrap-select/dist/css/bootstrap-select.min.css">
@endsection

<!-- 主体部分 -->
@section('container')
    <!--  为了美观,建议大家都把新内容都放card组件里面  -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-body py-3">
      <form class="row row-cols-sm-auto g-3 align-items-center">
        <div class="col-12">
          <div class="row">
            <label for="username" class="col-sm-auto col-form-label">用户名</label>
            <div class="col">
              <input type="email" class="form-control" id="username" name="username">
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <label for="phone" class="col-sm-auto col-form-label">手机号</label>
            <div class="col">
              <input type="email" class="form-control" id="phone" name="phone">
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <label for="beginTime" class="col-sm-auto col-form-label">创建时间</label>
            <div class="col">
              <div class="input-group">
                <input type="text" readonly class="form-control" aria-label="q"
                       placeholder="开始时间"
                       name="beginTime" id="beginTime">
                <span class="input-group-text"><i class="bi bi-arrow-left-right"></i></span>
                <input type="text" readonly class="form-control" aria-label="q"
                       placeholder="结束时间"
                       name="endTime" id="endTime">
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <label for="status" class="col-sm-auto col-form-label">用户状态</label>
            <div class="col">
              <select class="selectpicker">
                <option value="0">所有</option>
                <option value="1">正常</option>
                <option value="2">停用</option>
              </select>
            </div>
          </div>
        </div>


        <div class="col-12 gap-2">

          <button type="button" class="btn btn-light bsa-querySearch-btn">
            <i class="bi bi-search"></i>搜索
          </button>
          <button type="button" class="btn btn-light bsa-reset-btn">
            <i class="bi bi-arrow-clockwise"></i>重置
          </button>

        </div>

      </form>
    </div>
    <div class="card-body">
      <!--  表格上方左侧的工具条区域    -->
      <div id="toolbar" class="d-flex flex-wrap gap-2 mb-2">
        <button class="btn btn-light add-btn"><i
          class="bi bi-plus"></i> 新增
        </button>
        <button class="btn btn-light batch-btn" disabled><i class="bi bi-trash"></i> 批量删除</button>
        <button class="btn btn-light"><i class="bi bi-box-arrow-down"></i> 导入</button>
        <button class="btn btn-light"><i class="bi bi-box-arrow-up"></i> 导出</button>
      </div>
      <!--  数据表格    -->
      <table id="table"></table>
    </div>
  </div>

    <!--回到顶部开始-->
    <a href="javaScript:" class="bsa-back-to-top"><i class='bi bi-arrow-up-short'></i></a>
    <!--回到顶部结束-->
@endsection

<!-- 主体以下 -->
@section('more')


<script src="/lib/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="/lib/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js"></script>
<script src="/lib/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="/lib/bootstrap-table/dist/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/lib/bootstrap-table/dist/extensions/fixed-columns/bootstrap-table-fixed-columns.min.js"></script>
<script src="/lib/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="/lib/bootstrap-select/dist/js/i18n/defaults-zh_CN.min.js"></script>
<!--假数据模拟,生产环境中请直接删除该js-->
<script src="../dist/js/bootstrap-admin.mock.js"></script>






<script>
  $(document).ready(function (e) {

    // 新增用户
    $('.add-btn').on('click', function () {
      // window :建议加上该前缀,否则在子页面中通过parent.modalInstance 获取不到该实例对象,因为它现在处于一个匿名函数里
      window.modalInstance = $.modal({
        url: 'user-add.html',
        title: '用户添加',
        //禁用掉底部的按钮区域
        buttons: [],
        modalDialogClass: 'modal-dialog-centered modal-lg',
        onHidden: function (obj, data) {
          if (data === true) {
            //刷新当前数据表格
            $('#table').bootstrapTable('refresh');
            $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
          }
        }
      })
    })

    /**
     * columns表示列，里面的对象 title是表头信息，field是服务端返回的字段名称
     * 1.不做分页，返回的数据格式是 [{},{}]
     * 2.如果要开启分页，需要配置pagination:true, sidePagination:'client|server'
     * 3.客户端分页所需要的格式和不做分页时是一样的 都是 :[{},{}]
     * 4.服务端分页返回的格式为：{rows:[{},{}],total:200}
     * 参考：https://github.com/wenzhixin/bootstrap-table-examples/blob/master/json/data2.json
     */
    $('#table').bootstrapTable({
      //配置语言
      locale: 'zh-CN',
      //设置高度就可以固定表头
      // height: 500,
      //请求地址
      url: '/user',
      responseHandler: function (res) {
        return res.data;
      },
      //固定列功能开启
      fixedColumns: true,
      //左侧固定列数
      fixedNumber: 1,
      //右侧固定列数
      fixedRightNumber: 1,

      //是否开启分页
      pagination: true,
      //是客户端分页还是服务端分页  'client','server',由于演示没有后端提供服务，所以采用前端分页演示
      sidePagination: 'client',
      // 初始化加载第一页，默认第一页
      pageNumber: 1,
      //默认显示几条
      pageSize: 5,
      //可供选择的每页的行数 - (亲测大于1000存在渲染问题)
      pageList: [5, 10, 25, 50, 100],
      //在上百页的情况下体验较好 - 能够显示首尾页
      paginationLoop: true,
      // 展示首尾页的最小页数
      paginationPagesBySide: 2,

      // 唯一ID字段
      uniqueId: 'id',
      // 每行的唯一标识字段
      idField: 'id',
      // 是否启用点击选中行
      clickToSelect: true,
      // 是否显示详细视图和列表视图的切换按钮
      showToggle: true,
      // 请求得到的数据类型
      dataType: 'json',
      // 请求方法
      method: 'get',
      // 工具按钮容器
      toolbar: '#toolbar',
      // 是否显示所有的列
      showColumns: true,
      // 是否显示刷新按钮
      showRefresh: true,
      // 显示图标
      showButtonIcons: true,
      // 显示文本
      showButtonText: false,
      // 显示全屏
      showFullscreen: false,
      // 开关控制分页
      showPaginationSwitch: false,
      // 总数字段
      totalField: 'total',
      // 当字段为 undefined 显示
      undefinedText: '-',
      // 排序方式
      sortOrder: "asc",

      // 按钮的类
      buttonsClass: 'light',
      // 类名前缀
      buttonsPrefix: 'btn',

      // 图标前缀
      iconsPrefix: 'bi',
      // 图标大小 undefined sm lg
      iconSize: undefined,
      // 图标的设置  这里只做了一个演示，可设置项目参考 https://examples.bootstrap-table.com/#options/table-icons.html
      icons: {
        fullscreen: 'bi-arrows-fullscreen',
      },
      //头部的那个复选框选中事件
      onCheckAll: function (row) {
        batchBtnStatusHandle()
      },
      //单行选中事件
      onCheck: function (row) {
        batchBtnStatusHandle()
      },
      //单行取消选中事件
      onUncheck: function (row) {
        batchBtnStatusHandle()
      },
      //头部的那个复选框取消选中事件
      onUncheckAll: function (row) {
        batchBtnStatusHandle()
      },
      //加载模板,不改的话，默认的会超出不好看
      loadingTemplate: function () {
        return '<div class="spinner-grow" role="status"><span class="visually-hidden">Loading...</span></div>';
      },
      onPostBody: function () {
        //重新启用弹出层,否则formatter格式化函数返回的html字符串上的tooltip提示不生效
        $('[data-bs-toggle="tooltip"]').each(function (i, el) {
          new bootstrap.Tooltip(el)
        })
      },
      //params是一个对象
      queryParams: function (params) {
        return {
          // 每页数据量
          limit: params.limit,
          // sql语句起始索引
          offset: params.offset,
          page: (params.offset / params.limit) + 1,
          // 排序的列名
          sort: params.sort,
          // 排序方式 'asc' 'desc'
          sortOrder: params.order,
          //关键词
          keywords: $('input[name=keyword]').val(),
          //开始时间
          beginTime: $('#beginTime').val(),
          //结束时间
          endTime: $('#endTime').val(),
        }
      },
      //列
      columns: [
        {
          checkbox: true,
          //是否显示该列
          visible: true,
        },
        {
          title: 'ID',
          field: 'id',
          // 使用[align]，[halign]和[valign]选项来设置列和它们的标题的对齐方式。h表示横向，v标识垂直
          align: 'center',
          // 是否作为排序列
          sortable: true,
          // 当列名称与实际名称不一致时可用
          sortName: 'sortId',
          switchable: false,
          // 列的宽度
          width: 8,
          // 宽度单位
          widthUnit: 'rem'
        },
        {
          title: '姓名',
          field: 'name',
          align: 'center'
        },
        {
          title: '角色',
          field: 'role_id',
          align: 'center',
          formatter: formatRole
        },
        {
          title: '用户名',
          field: 'username',
          align: 'center',
        },
        {
          title: '性别',
          field: 'gender',
          align: 'center',
          formatter: formatGender
        },
        {
          title: '手机',
          field: 'phone',
          align: 'center',
        },
        {
          title: '邮箱',
          field: 'email',
          align: 'center',
        },
        {
          title: '加入时间',
          field: 'create_at',
          align: 'center',
        },
        {
          title: '状态',
          field: 'status',
          align: 'center',
          formatter: formatStatus
        },
        {
          title: '操作',
          align: 'center',
          formatter: formatAction,
          events: {
            'click .edit-btn': function (event, value, row, index) {
              event.stopPropagation();

              window.modalInstance = $.modal({
                url: 'user-edit.html',
                title: '用户编辑',
                //禁用掉底部的按钮区域
                buttons: [],
                modalDialogClass: 'modal-dialog-centered modal-lg',
                onHidden: function (obj, data) {
                  if (data === true) {
                    //刷新当前数据表格
                    $('#table').bootstrapTable('refresh');
                    $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
                  }
                }
              })

            },
            'click .del-btn': function (event, value, row, index) {
              event.stopPropagation();
              $.modal({
                body: '确定要删除管理员' + row.name + '?',
                ok: function () {

                  $.ajax({
                    url: '/user/10',
                    method: 'delete',
                  }).then(response => {
                    if (response.code === 200) {

                    }
                  });

                }
              })

            },
            'click .role-btn': function (event, value, row, index) {
              event.stopPropagation();

              window.rolemodal = $.modal({
                url: 'user-role.html',
                title: '分配角色',
                //禁用掉底部的按钮区域
                buttons: [],
                modalDialogClass: 'modal-dialog-centered modal-lg',
                onHidden: function (obj, data) {
                  if (data === true) {
                    //刷新当前数据表格
                    $('#table').bootstrapTable('refresh');
                    $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
                  }
                }
              })

            }
          }
        }
      ]
    });


    //批量处理
    $('.batch-btn').on('click', function () {
      //获取所有选中行的id
      let id = [];
      let rowSelected = $("#table").bootstrapTable('getSelections');
      $.each(rowSelected, function (index, row) {
        id.push(row.id);
      })

      //发送ajax
      $.modal({
        body: '确定要删除所选用户吗?',
        ok: function () {
          $.ajax({
            url: '/user/10',
            method: 'delete',
            data: {id},
          }).then(response => {
            if (response.code === 200) {
              $.toasts({
                type: 'success',
                delay: 1500,
                content: '删除成功',
                onHidden: function () {

                  $('#table').bootstrapTable('refresh');
                  $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
                  //把批量删除按钮变成禁止点击
                  $('.batch-btn').attr('disabled', true)
                }
              })
            }
          });
        }
      })
    })


    //处理批量按钮的disabled状态
    function batchBtnStatusHandle() {
      let rowSelected = $("#table").bootstrapTable('getSelections');
      if (rowSelected.length > 0) {
        $('.batch-btn').attr('disabled', false)
      } else {
        $('.batch-btn').attr('disabled', true)
      }
    }


    function formatRole(val, rows) {
      switch (val) {
        case 1:
          return '经理'
        case 2:
          return '组长'
        case 3:
          return '研发组长'
        case 4:
          return '客服'
        case 5:
          return '文章审核员'
        case 6:
          return '销售'
        default:
          return '<span class="badge text-bg-danger">未分配</span>'
      }

    }

    function formatGender(val, rows) {
      return val === true ? '男' : '女';
    }

    //格式化列数据演示 val:当前数据 rows:当前整行数据
    function formatStatus(val, rows) {
      return val === 1 ? '<span class="badge text-bg-success">正常</span>' : '<span class="badge text-bg-danger">停用</span>';
    }


    //格式化列数据演示 val:当前数据 rows:当前整行数据
    function formatAction(val, rows) {

      let html = '';


      //第一个按钮(你可以在这里判断用户是否有修改权限来决定是否显示)
      html += `<button type="button" class="btn btn-light btn-sm edit-btn" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="修改用户"><i class="bi bi-pencil"></i></button>`;

      //第二个按钮
      html += `<button type="button" class="btn btn-light mx-1 btn-sm del-btn" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="删除用户"><i class="bi bi-trash3"></i></button>`


      //第三个按钮
      html += `<button type="button" class="btn btn-light btn-sm role-btn" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="分配角色"><i class="bi bi-person-square"></i></button>`

      return html;
    }

    //搜索处理
    $('.bsa-querySearch-btn').on('click', function () {
      $('#table').bootstrapTable('refresh');
      $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
    })

    //重置处理
    $('.bsa-reset-btn').on('click', function () {

      //把所有的字段都恢复默认值
      $('#username').val('');
      $('#phone').val('');
      $('#beginTime').val('');
      $('#endTime').val('');
      $('#status').val('0');
      //刷新回到第一页
      $('#table').bootstrapTable('refresh');
      $('#table').bootstrapTable('selectPage', 1)//跳转到第一页
    })

    //==============================日期时间插件====================================


    //日期时间的翻译，由于该插件没有内置中文翻译，需要手动通过选项进行翻译
    let td_zh = {
      today: '回到今天',
      clear: '清除选择',
      close: '关闭选取器',
      selectMonth: '选择月份',
      previousMonth: '上个月',
      nextMonth: '下个月',
      selectYear: '选择年份',
      previousYear: '上一年',
      nextYear: '下一年',
      selectDecade: '选择十年',
      previousDecade: '上一个十年',
      nextDecade: '下一个十年',
      previousCentury: '上一个世纪',
      nextCentury: '下一个世纪',
      pickHour: '选取时间',
      incrementHour: '增量小时',
      decrementHour: '递减小时',
      pickMinute: '选取分钟',
      incrementMinute: '增量分钟',
      decrementMinute: '递减分钟',
      pickSecond: '选取秒',
      incrementSecond: '增量秒',
      decrementSecond: '递减秒',
      toggleMeridiem: '切换上下午',
      selectTime: '选择时间',
      selectDate: '选择日期',
    }

    //自定义日期格式插件
    let td6 = new tempusDominus.TempusDominus(document.getElementById('beginTime'), {
      //本地化控制
      localization: {
        ...td_zh,//展开语法
        format: 'yyyy-MM-dd HH:mm:ss',
      },
      //布局控制
      display: {
        //视图模式(选择年份视图最先开始)
        viewMode: 'calendar',
        components: {
          //是否开启日历，false:则是时刻模式
          calendar: true,
          //支持年份选择
          year: true,
          //是否开启月份选择
          month: true,
          //支持日期选择
          date: true,
          //底部按钮中那个时刻选择是否启用，false则表示隐藏，下面三个需要该选项为true时有效
          clock: true,
          //时
          hours: true,
          //分
          minutes: true,
          //秒
          seconds: true
        },
        //图标
        icons: {
          time: 'bi bi-clock',
          date: 'bi bi-calendar',
          up: 'bi bi-arrow-up',
          down: 'bi bi-arrow-down',
          previous: 'bi bi-chevron-left',
          next: 'bi bi-chevron-right',
          today: 'bi bi-calendar-check',
          clear: 'bi bi-trash',
          close: 'bi bi-x',
        },
        //视图底部按钮
        buttons: {
          today: true,
          clear: true,
          close: true,
        },
      }
    });
    let td7 = new tempusDominus.TempusDominus(document.getElementById('endTime'), {
      //本地化控制
      localization: {
        ...td_zh,//展开语法
        format: 'yyyy-MM-dd HH:mm:ss',
        //是否使用24小时制,比如3.15分会变成15.15
        // hourCycle: 'h24'
      },
      //布局控制
      display: {
        //视图模式(选择年份视图最先开始)
        viewMode: 'calendar',
        components: {
          //是否开启日历，false:则是时刻模式
          calendar: true,
          //支持年份选择
          year: true,
          //是否开启月份选择
          month: true,
          //支持日期选择
          date: true,
          //底部按钮中那个时刻选择是否启用，false则表示隐藏，下面三个需要该选项为true时有效
          clock: true,
          //时
          hours: true,
          //分
          minutes: true,
          //秒
          seconds: true
        },
        //图标
        icons: {
          time: 'bi bi-clock',
          date: 'bi bi-calendar',
          up: 'bi bi-arrow-up',
          down: 'bi bi-arrow-down',
          previous: 'bi bi-chevron-left',
          next: 'bi bi-chevron-right',
          today: 'bi bi-calendar-check',
          clear: 'bi bi-trash',
          close: 'bi bi-x',
        },
        //视图底部按钮
        buttons: {
          today: true,
          clear: true,
          close: true,
        },
      }
    });
    //事件监听设定起始时间为td7实例的选中时间
    td6.subscribe(tempusDominus.Namespace.events.change, (e) => {
      td7.updateOptions({
        restrictions: {
          minDate: e.date,
        },
      });
    });
    //事件监听设定起始时间为td6实例的选中时间
    td7.subscribe(tempusDominus.Namespace.events.change, (e) => {
      td6.updateOptions({
        restrictions: {
          maxDate: e.date,
        },
      });
    });

    //下拉框美化插件，原生的bootstrap它会调用系统的那个下拉菜单
    $('select').selectpicker();
  });


</script>
@endsection


