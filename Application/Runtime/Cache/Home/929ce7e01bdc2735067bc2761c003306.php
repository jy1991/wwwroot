<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>华为商城官网-提供华为手机(华为Mate8、荣耀7、畅玩5X、荣耀6Plus、华为P8、荣耀畅玩4C、荣耀4A等)、平板电脑、移动终端等产品的预约和购买</title>

    <!-- Bootstrap -->
    <link href="/wwwroot/Public/Dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/wwwroot/Public/Dist/css/index.css" rel="stylesheet">
    <link href="/wwwroot/Public/Dist/css/login.css" rel="stylesheet">
    <script type="text/javascript" src="/wwwroot/Public/assets/js/jquery-2.0.3.min.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!--导航条--> 
  <div class="hr-10"></div> 
  <nav class="navbar navbar-default nav-height">
  <div class="container-fluid  nav-height">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">导航条</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-height">
        <li><a href="<?php echo U('Index/index');?>">华为官网</a></li>
        <li><a class="shu">|</a></li>
        <li><a href="#">华为荣耀</a></li>
        <li><a class="shu">|</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">软件应用 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">EMUI</a></li>
            <li><a href="#">应用市场</a></li>
            <li><a href="#">云服务</a></li>
            <li><a href="#">开发者联盟</a></li>
          </ul>
        </li>
        <li><a class="shu">|</a></li>
        <li><a href="#">花粉俱乐部</a></li>
        <li><a class="shu">|</a></li>
        <li><a href="#">Select Region</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right nav-height">
        <li>
              <?php if(empty($_SESSION['home_user'])): ?><a href="<?php echo U('Public/login');?>">登录</a>
              <?php else: ?><a><?php echo ($_SESSION['home_user']['user']); ?></a><?php endif; ?>
        </li>
        <li>
              <?php if(empty($_SESSION['home_user'])): else: ?><a href="<?php echo U('User/index');?>">用户中心</a><?php endif; ?>
        </li>
        <li>
              <?php if(empty($_SESSION['home_user'])): ?><a href="<?php echo U('Public/add');?>">注册</a>
              <?php else: ?><a href="<?php echo U('Public/loginout');?>">退出</a><?php endif; ?>
        </li>
        <li><a class="shu">|</a></li>
        <li><a href="<?php echo U('Order/index');?>">我的订单</a></li>
        <li><a class="shu">|</a></li>
        <li><a href="#">V码(优购码)</a></li>
        <li><a class="shu">|</a></li>
        <li><a href="#">手机版</a></li>
        <li><a class="shu">|</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">网站导航 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">帮助中心</a></li>
            <li><a href="#">PC软件</a></li>
            <li><a href="#">数字音乐</a></li>
            <li><a href="#">爱旅</a></li>
            <li><a href="#">华为网盘</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<header class="header">
  <div class="layout m0a">
    <div class="logo"><a href="<?php echo U('Index/index');?>" title="Vmall.com - 华为商城"><img src="/wwwroot/Public/Dist/images/newLogo.png" alt="Vmall.com - 华为商城"/></a></div>
    <div class="searchBar">
    <!-- 页头热门搜索 -->
    <div class="searchBar-form" id="searchBar-area">
        <form method="get" onsubmit="return search(this)">					
            <input type="text" class="text" maxlength="100" id="search-kw" /><input type="submit" class="button" value="搜索" />
            <input type="hidden" id="default-search" value="荣耀6 plus"/>
        </form>
    </div>
    
        <div class="searchBar-key">
        <b>热门搜索：</b>
	    <a href="/search?keyword=5X" target="_blank">5X</a>
	    <a href="/search?keyword=%E8%8D%A3%E8%80%807" target="_blank">荣耀7</a>
	    <a href="/search?keyword=Mate%20S" target="_blank">Mate S</a>
	    <a href="/search?keyword=4A" target="_blank">4A</a>
	    <a href="/search?keyword=Mate%208" target="_blank">Mate 8</a>
	    <a href="/search?keyword=%E7%83%AD%E9%97%A8%E9%85%8D%E4%BB%B6" target="_blank">热门配件</a>
	    </div>
    </div>
    <!-- -搜索条-end -->
		<!-- -头部-工具栏-start -->
		<div class="header-toolbar">
			<!-- -头部-工具栏-焦点为header-toolbar-item增加ClassName:hover -->
			<div class="header-toolbar-item" id="header-toolbar-imall">
				<!-- -我的商城-start -->
				<div class="i-mall">
					<div class="h"><a href="/member?t=1455600335222timestamp" rel="nofollow" timeType="timestamp">我的商城</a>
					<i></i><s></s><u></u></div>
					<div class="b" id="header-toolbar-imall-content">
						<div class="i-mall-prompt" id="cart_unlogin_info">
							<p>你好，请&nbsp;&nbsp;<script>document.write('<a href="/account/login?url='+encodeURIComponent(window.location.pathname)+'"  rel="nofollow">登录</a>');</script> | <a href="/account/register" rel="nofollow">注册</a></p>
						</div>
						<div class="i-mall-uc " id="cart_login_info">
							<ul>
								<li><a href="http://www.vmall.com/member/order?t=1455600335222timestamp" rel="nofollow" timeType="timestamp">我的订单</a></li>
								<li><a href="/member/order?t=1455600335222timestamp&tab=unpaid" timeType="timestamp">待支付</a><span id="toolbar-orderWaitingHandleCount" class="hide">0</span></li>
								<li><a href="/member/order?t=1455600335222timestamp&tab=nocomment" timeType="timestamp">待评论</a><span id="toolbar-notRemarkCount" class="hide">0</span></li>
								<li><a href="/member/coupon?t=1455600335222timestamp" timeType="timestamp">优惠券</a><span id="toolbar-couponCount" class="hide">0</span></li>
								<li><a href="/member/msg?t=1455600335222timestamp" timeType="timestamp">站内信</a><span id="toolbar-newMsgCount" class="hide">0</span></li>
							</ul>
						</div>
						<!-- 页头会员专享信息 -->
						<div class="i-mall-event " >
							<p><a href="http://www.vmall.com/notice-657"><img src="http://res.vmallres.com/pimages//sale/2016-01/20160127095348354.jpg" alt="特权频道" /></a></p>
						</div>
					</div>
				</div><!-- -我的商城-end -->
			</div>
    <div class="header-toolbar-item" id="header-toolbar-minicart">
    <!-- -迷你购物车-start -->
    <div class="minicart">
        <div class="h" id="header-toolbar-minicart-h"><a href="<?php echo U('Cart/index');?>" rel="nofollow" timeType="timestamp">我的购物车<span><em id="header-cart-total">0</em><b></b></span></a><i></i><s></s><u></u></div>
        <div class="b" id="header-toolbar-minicart-content">
            <div class="minicart-pro-empty" id="minicart-pro-empty">
                <span class="icon-minicart">您的购物车是空的，赶紧选购吧！</span>
            </div>
            <div id="minicart-pro-list-block">
            <ul class="minicart-pro-list" id="minicart-pro-list">
                                            
            </ul>
            </div>
            <div class="minicart-pro-settleup" id="minicart-pro-settleup">
                <p>共<em id="micro-cart-total">0</em>件商品，金额合计<b id="micro-cart-totalPrice">&yen;&nbsp;0</b></p>
                <a class="button-minicart-settleup" href="http://cart.vmall.com/cart/cart.html">去结算</a>
            </div>
        </div>
    </div><!-- -迷你购物车-end -->
  </div>    
</div>
<!-- -头部-工具栏-start -->
		<!-- -头部-二维码-start -->
		<div class="header-qrcode">
			<div class="ec-slider" id="ec-erweima">
				<ul class="ec-slider-list">
					<li class="ec-slider-item">
						<p><a href="http://www.vmall.com/appdownload" target="blank" title="扫码下载客户端"><img src="/wwwroot/Public/Dist/images/qrcode_vmall_app01.png" alt="华为商城官方客户端"/></a></p>
						<p><a href="http://www.vmall.com/appdownload" target="blank"><span>扫码下载客户端</span></a></p>
					</li>
					<li class="ec-slider-item">
						<p><a href="http://www.vmall.com/appdownload" target="blank" title="微信扫码关注我们"><img src="/wwwroot/Public/Dist/images/qrcode_vmall_wechat01.jpg" alt="华为商城官方微信"/></a></p>
						<p><a href="http://www.vmall.com/appdownload" target="blank"><span>微信扫码关注我们</span></a></p>
					</li>
				</ul>
                <div class="ec-slider-nav">
                <span class="current"></span>
                <span class=""></span>
                </div>
                <a class="button-slider-prev" href="javascript:;" style="display: none;"></a>
                <a class="button-slider-next" href="javascript:;" style="display: none;"></a>
			</div>
		</div><!-- -头部-二维码-end -->
	</div>			
</header>
<!-- -头部-end -->
<!-- 导航 -->
<div class="naver-main">
  <div class="layout">
    <div id="category-block" class="category category-index">
      <div class="h">
		<h2>全部商品</h2>
		<i class="icon-category"></i>
	  </div>
      
    </div>
    <!--导航栏目-->
    <nav class="naver">
      <ul id="naver-list">
        <li id="index" class="">
        <a class="current" href="<?php echo U('Index/index');?>">
        <span>首 页 </span>
        </a>
        </li>
        <li id="honor" class="">
        <a target="_blank" href="#">
        <span>
        荣耀全球情人节
        <s>
        <img alt="new" src="/wwwroot/Public/Dist/images/new.png">
        </s>
        </span>       
        </a> 
        </li>
        <li id="honor" class="">
        <a target="_blank" href="#">
        <span>
        荣耀6 Plus直降200
        <s>
        <img alt="new" src="/wwwroot/Public/Dist/images/new.png">
        </s>
        </span>       
        </a> 
        </li>
        <li id="honor" class="">
        <a target="_blank" href="#">
        <span>
        HUAWEI Mate 8 					
        </span>       
        </a> 
        </li>
        <li id="honor" class="">
        <a target="_blank" href="#">
        <span>
        荣耀 7 					
        </span>       
        </a> 
        </li>
        <li class="">
        <a href="javascript:;">
        <span>精彩频道</span>
        <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
        </a>

        </li>
      </ul>

    </nav>
    
  </div>

</div>
<!--主体部分-->


<!--修改用户-->
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning">
    我的商城
  </a>
  <a href="<?php echo U('Cart/index');?>" class="list-group-item">购物车</a>
  <a href="<?php echo U('Address/index');?>" class="list-group-item">收货地址</a>
  <a href="<?php echo U('Order/index');?>" class="list-group-item">订单</a>
  <a href="#" class="list-group-item">评价</a>
</div>
<div id="main_content">
  <style>
  th,td{
     text-align: center;
  }
  .list-group{
      width:200px;
      float: left;
      margin: 20px 0px 0px 40px;
  }
  </style>
<div class="panel panel-default">
<div class="panel-heading">添 加 收 货 地 址</div>
</div>

    <form class="form-horizontal"  action='<?php echo U("add");?>' method='post'>
        <div class="form-group" style="margin-bottom:-50px;">
          <label for="person" class="col-sm-3 control-label">收货人姓名</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  name="person" value="">
            </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-3 control-label">收货人电话</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  name="phone" value="">
            </div>
         </div>
         <div class="form-group">
          <label for="address" class="col-sm-3 control-label">收货地址</label>
            <div class="col-sm-6">
              <input type="text" class="form-control"  name="address" value="">
            </div>
         </div>         
         
         <div class="form-group">
      			<label for="" class="col-sm-3 control-label">是否设为默认</label>
      				<div class="col-sm-6">
      				    <input type="radio" name='is_default' value="0" checked> 不默认 &nbsp;&nbsp;&nbsp;
      				    <input type="radio" name='is_default' value="1" > 默认
      				</div>
      	</div>
        
        <div class="form-group">
          <label for="" class="col-sm-3 control-label"></label>
          <div class="col-sm-3">
            <button type="submit" id="submit" class="btn btn-warning">保 存</button>
          </div>
        </div>
    </form>

<div class="panel panel-default">
<div class="panel-heading">管 理 收 货 地 址</div>
<div class="row">
    <div class="col-md-12">
      <table class='table table-striped table-bordered table-hover'>
      <thead>
        <tr>
          <th>收货人姓名</th>
          <th>收货人电话</th>
          <th>收货人地址</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo["person"]); ?></td>
          <td><?php echo ($vo["phone"]); ?></td>
          <td><?php echo ($vo["address"]); ?></td>
          <td>
            
<?php if($vo['is_default'] == 0): ?><a href="<?php echo U('delete', array('id'=>$vo['id']));?>" class="btn btn-danger">删除</a> 
          <a href="<?php echo U('set_default', array('id'=>$vo['id']));?>" class="btn btn-success">设为默认</a>
<?php else: ?> 
          <a href="" class="btn btn-info">默认地址</a><?php endif; ?>                      
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>

  </div>
</div>



</body>
</html>