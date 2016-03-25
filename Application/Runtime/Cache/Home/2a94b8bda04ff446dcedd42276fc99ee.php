<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/wwwroot/Public/Dist/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/wwwroot/Public/Dist/js/bootstrap.min.js"></script>
    <script src="/wwwroot/Public/Dist/js/index.js"></script>
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
        <li><a href="#">华为官网</a></li>
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
    <div class="logo"><a href="/index.html" title="Vmall.com - 华为商城"><img src="/wwwroot/Public/Dist/images/newLogo.png" alt="Vmall.com - 华为商城"/></a></div>
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
      <div class="b">
         <!--分类-->
         <ol class="category-list">
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><li class="category-item ">
             <div class="category-info">
                <h3>
                <a target="_blank" href="/list-36">
                  <span><?php echo ($cate["name"]); ?> </span>
                </a>
                </h3>
                <?php if(is_array($cate["child"])): $i = 0; $__LIST__ = $cate["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><a target="_blank" href="/list-75">
                  <span><?php echo ($child["name"]); ?> </span>
                </a><?php endforeach; endif; else: echo "" ;endif; ?>
             </div>
             <div class="category-panels children-col-1">
               <ul class="subcate-list children-col-list">
                <?php if(is_array($cate["child"])): $i = 0; $__LIST__ = $cate["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li class="subcate-item">
                    <a target="_blank" href="/list-75">
                      <span><?php echo ($child["name"]); ?> </span>
                    </a>
                  </li><?php endforeach; endif; else: echo "" ;endif; ?>  
                  <dl class="category-banner children-col-2">
                    <dt><span>推荐商品</span></dt>
                       <dd><a href="#" >以旧换新 </a></dd>
                       <dd><a href="#" target="_blank">华为 Mate 8 </a></dd>
                       <dd><a href="#" target="_blank">荣耀畅玩5X </a></dd>
                </dl>
               </ul>
             </div>
           </li><?php endforeach; endif; else: echo "" ;endif; ?> 
         </ol>
      </div>  
    </div>
    <!--导航栏目-->
    <nav class="naver">
      <ul id="naver-list">
        <li id="index" class="">
        <a class="current" href="/index.html">
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
<!--          <ol>
          <li id="honor" class="">
          <a target="_blank" href="http://www.vmall.com/honor/remind">开售提醒</a>
          </li>
          </ol> -->
        </li>
      </ul>

    </nav>
    
  </div>

</div>
<!--轮播图-->
<div class="hot-board">
  <div id="index_slider" class="ec-slider">
    <ul class="ec-slider-list">
      <li class="ec-slider-item" style="background: rgb(211, 198, 176) url(/wwwroot/Public/Dist/images/20160205104705161.jpg) scroll 50% 0px; width: 1345px; height: 448px; position: absolute; display: list-item;">
        <div class="ec-slider-item-img" style="width:100%;">
<a target="_blank" href="http://www.vmall.com/product/2647.html" style="width:100%;height:448px;display:block;"></a>
        </div>
      </li>
      
    </ul>
    <!--数字下标-->
    <div class="ec-slider-nav-1">
       <span class="current">1</span>
       <span class="">2</span>
       <span class="">3</span>
       <span class="">4</span>
       <span class="">5</span>
       <span class="">6</span>
       <span class="">7</span>
    </div>
    <a class="button-slider-prev" href="javascript:;" style="display: none;"></a>
    <a class="button-slider-next" href="javascript:;" style="display: none;"></a>
  </div>
</div>
<!--轮播图 end-->
<div class="hr-20"></div>
<!--正文1 start-->
<div class="layout">
  <div class="fl u-4-3">
    <div class="channel-favorable">
       <ul id="main-sale-list" class="channel-pro-list">
         <li id="channel-pro-favorable-1" class="channel-pro-item channel-pro-favorable-item-1" data-skuid="6701" data-skutype="1" data-activityid="">
           <div class="channel-pro-panels">
              <div class="pro-info">
                 <div class="p-img">
                 <a target="_blank" title="荣耀7" href="/product/2172.html">
                 <img alt="荣耀7" src="/wwwroot/Public/Dist/images/1455639470078.png">
                 </a>
                 </div>
                 <div class="p-name">
                   <a target="_blank" title="荣耀7" href="/product/2172.html"> 荣耀7</a>
                 </div>
                 <div class="p-shining">
                   <div class="p-slogan">开启移动互联新体验</div>
                   <div class="p-promotions">选购配件套装更超值</div>
                 </div> 
                 <div class="p-price">
                   <em>¥</em>
                   <span>1829</span>
                 </div> 
                 <div class="p-button">
                   <a class="channel-button" target="_blank" href="/product/2172.html">立即抢购</a>
                 </div>
                 <div class="p-countdown hide">
                   <span class="p-time"></span>
                   <span class="p-quantity" style="display:none"></span>
                 </div>
                 <i class="p-tag">
                   <img alt="" src="/wwwroot/Public/Dist/images/1382542488099.png">
                 </i>
              </div><!--pro-info-->
            </div><!--channel-pro-panels-->
         </li>
         <li id="channel-pro-favorable-2" class="channel-pro-item channel-pro-favorable-item-1" data-skuid="6701" data-skutype="1" data-activityid="">
           <div class="channel-pro-panels">
              <div class="pro-info">
                 <div class="p-img">
                 <a target="_blank" title="荣耀7" href="/product/2172.html">
                 <img alt="荣耀7" src="/wwwroot/Public/Dist/images/1455639470078.png">
                 </a>
                 </div>
                 <div class="p-name">
                   <a target="_blank" title="荣耀7" href="/product/2172.html"> 荣耀7</a>
                 </div>
                 <div class="p-shining">
                   <div class="p-slogan">开启移动互联新体验</div>
                   <div class="p-promotions">选购配件套装更超值</div>
                 </div> 
                 <div class="p-price">
                   <em>¥</em>
                   <span>1829</span>
                 </div> 
                 <div class="p-button">
                   <a class="channel-button" target="_blank" href="/product/2172.html">立即抢购</a>
                 </div>
                 <div class="p-countdown hide">
                   <span class="p-time"></span>
                   <span class="p-quantity" style="display:none"></span>
                 </div>
                 <i class="p-tag">
                   <img alt="" src="/wwwroot/Public/Dist/images/1382542488099.png">
                 </i>
              </div><!--pro-info-->
            </div><!--channel-pro-panels-->
         </li>
         <li id="channel-pro-favorable-3" class="channel-pro-item channel-pro-favorable-item-1" data-skuid="6701" data-skutype="1" data-activityid="">
           <div class="channel-pro-panels">
              <div class="pro-info">
                 <div class="p-img">
                 <a target="_blank" title="荣耀7" href="/product/2172.html">
                 <img alt="荣耀7" src="/wwwroot/Public/Dist/images/1455639470078.png">
                 </a>
                 </div>
                 <div class="p-name">
                   <a target="_blank" title="荣耀7" href="/product/2172.html"> 荣耀7</a>
                 </div>
                 <div class="p-shining">
                   <div class="p-slogan">开启移动互联新体验</div>
                   <div class="p-promotions">选购配件套装更超值</div>
                 </div> 
                 <div class="p-price">
                   <em>¥</em>
                   <span>1829</span>
                 </div> 
                 <div class="p-button">
                   <a class="channel-button" target="_blank" href="/product/2172.html">立即抢购</a>
                 </div>
                 <div class="p-countdown hide">
                   <span class="p-time"></span>
                   <span class="p-quantity" style="display:none"></span>
                 </div>
                 <i class="p-tag">
                   <img alt="" src="/wwwroot/Public/Dist/images/1382542488099.png">
                 </i>
              </div><!--pro-info-->
            </div><!--channel-pro-panels-->
         </li>
         <li id="channel-pro-favorable-4" class="channel-pro-item channel-pro-favorable-item-1" data-skuid="6701" data-skutype="1" data-activityid="">
           <div class="channel-pro-panels">
              <div class="pro-info">
                 <div class="p-img">
                 <a target="_blank" title="荣耀7" href="/product/2172.html">
                 <img alt="荣耀7" src="/wwwroot/Public/Dist/images/1455639470078.png">
                 </a>
                 </div>
                 <div class="p-name">
                   <a target="_blank" title="荣耀7" href="/product/2172.html"> 荣耀7</a>
                 </div>
                 <div class="p-shining">
                   <div class="p-slogan">开启移动互联新体验</div>
                   <div class="p-promotions">选购配件套装更超值</div>
                 </div> 
                 <div class="p-price">
                   <em>¥</em>
                   <span>1829</span>
                 </div> 
                 <div class="p-button">
                   <a class="channel-button" target="_blank" href="/product/2172.html">立即抢购</a>
                 </div>
                 <div class="p-countdown hide">
                   <span class="p-time"></span>
                   <span class="p-quantity" style="display:none"></span>
                 </div>
                 <i class="p-tag">
                   <img alt="" src="/wwwroot/Public/Dist/images/1382542488099.png">
                 </i>
              </div><!--pro-info-->
            </div><!--channel-pro-panels-->
         </li>
       </ul>
    </div>
  </div>
  <!--领卷立减-->
  <div class="fr u-4-1">
    <div class="channel-sale">
      <div id="group-slider" class="ec-slider">
        <ul id="slider-sale-list" class="channel-pro-list ec-slider-list">
          <li class="channel-pro-item ec-slider-item" data-block="slider">
            <p>
              <a target="_blank" href="http://sale.vmall.com/honor6plus.html">
                <img title="荣耀6 Plus" src="/wwwroot/Public/Dist/images/20160217121935268.jpg">
              </a>
            <br>
            </p>
          </li>
        </ul>
      </div>
    </div>
    <div class="hr-20"></div>
    <div class="ecnews-area">
      <div class="h">
        <div class="h-tab">
          <ul>
            <li id="tab-notice" class="current">
              <a href="/notice-list">公告</a>
            </li>
            <li id="tab-news" class="">
              <a href="/news-list">新闻</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="b">
        <ul id="tab-notice-content" style="display: block;">
          <li>
            <a target="_blank" title="荣耀情人节 爱耀零距离！3天9场狂欢购！" href="/notice-801">荣耀情人节 爱耀零距离！3天9场狂欢购！</a>
          </li>
          <li>
            <a target="_blank" title="华为商城新春致辞" href="/notice-825">华为商城新春致辞</a>
          </li>
          <li>
            <a target="_blank" title="荣耀家族春节不打烊" href="/notice-821">荣耀家族春节不打烊</a>
          </li>
          <li>
            <a target="_blank" title="VMALL春节不打烊 购机评价赢好礼" href="/notice-817">VMALL春节不打烊 购机评价赢好礼</a>
          </li>
          <li>
            <a target="_blank" title="【中奖名单】华为M2 10.0平板下单有奖&点评有奖活动" href="/notice-793">【中奖名单】华为M2 10.0平板下单有奖&点评有奖活动</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="hr-20"></div>
    <div class="banner">
      <p>
        <a href="#" target="_blank">
          <img src="http://res.vmallres.com/pimages//sale/2016-01/20160125143601918.jpg">
        </a>
      </p>
    </div>
    <div class="hr-20"></div>
  </div>
</div>
<!--正文1 end-->
<!--广告 start-->
<div class="layout">
  <div class="banner">
    <div class="banner-slideshow">
      <div id="m-banner" class="ec-slider">
        <ul class="ec-slider-list">
           <li class="ec-slider-item" style="width: 1200px; height: 160px; position: absolute; display: list-item;">
             <div class="ec-slider-item-img">
               <a target="_blank" href="#">
                 <img src="/wwwroot/Public/Dist/images/20160205165535912.jpg">
               </a>
             </div>
           </li> 
           <li class="ec-slider-item" style="width: 1200px; height: 160px; position: absolute; display: none;">
             <div class="ec-slider-item-img">
               <a target="_blank" href="#">
                 <img src="/wwwroot/Public/Dist/images/20160203120827751.jpg">
               </a>
             </div>
           </li>
           <li class="ec-slider-item" style="width: 1200px; height: 160px; position: absolute; display: none;">
             <div class="ec-slider-item-img">
               <a target="_blank" href="#">
                 <img src="/wwwroot/Public/Dist/images/20160128170356522.jpg">
               </a>
             </div>
           </li>
           <li class="ec-slider-item" style="width: 1200px; height: 160px; position: absolute; display: none;">
             <div class="ec-slider-item-img">
               <a target="_blank" href="#">
                 <img src="/wwwroot/Public/Dist/images/20160206144129789.jpg">
               </a>
             </div>
           </li>
        </ul>
        <div class="ec-slider-nav">
          <span class="current"></span>
          <span class=""></span>
          <span class=""></span>
          <span class=""></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!--广告 end-->
<div class="hr-20"></div>
<!--手机 start-->
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><div class="layout">
  <div class="channel-floor">
    <div class="h">
      <h2>
        <a target="_blank" title="<?php echo ($cate["name"]); ?>" href="/list-36"><?php echo ($cate["name"]); ?></a>
      </h2>
      <em class="channel-subtitle"></em>
      <ul class="channel-nav">
        <?php if(is_array($cate["child"])): $i = 0; $__LIST__ = $cate["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><li>
              <a target="_blank" href="/list-75"><?php echo ($child["name"]); ?></a>
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <div class="b">
      <ul class="channel-pro-list">

      <?php if(is_array($cate["pro"])): $i = 0; $__LIST__ = $cate["pro"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><li id="channel-pro-1-4" class="channel-pro-item">
          <div class="channel-pro-panels">
            <div class="pro-info">
              <div class="p-img">
                <a rel="nofollow" target="_blank" title="<?php echo ($pro["name"]); ?>" href="<?php echo U('Home/Product/index','num='.$pro['number']);?>">
                <img alt="" style="" src="<?php echo ($pro["img"]); ?>">
                </a>
              </div>
              <div class="p-name">
              <a target="_blank" title="<?php echo ($pro["name"]); ?>" href="<?php echo U('Home/Product/index','num='.$pro['number']);?>">
              <?php echo ($pro["name"]); ?>
              <span class="p-slogan"><?php echo ($pro["ad"]); ?></span>
              </a>
              </div>
              <div class="p-price">
              <em>¥</em>
              <span><?php echo ($pro["price"]); ?></span>
              </div>
            </div>
          </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
      
      </ul>
    </div>
  </div>
</div>
<div class="hr-20"></div><?php endforeach; endif; else: echo "" ;endif; ?>
<!--手机 end-->

<!--广告-->
<div class="layout">
  <div class="ad fl">
    <a href="http://www.vmall.com/recycle" target="_blank">
      <img style="float:none;" title="以旧换新" src="/wwwroot/Public/Dist/images/20160206144129789.jpg">
    </a>
  </div>
</div>
<div class="hr-40"></div>

<!--侧边栏-->
<div class="follow">
  <div class="layout">
    <ul>
      <li>
        <a class="follow-hwsoft" target="_blank" href="http://emui.huawei.com/appsoft/">
          <img alt="华为软件应用" src="/wwwroot/Public/Dist/images/follow_hwsoft_application.png">
        </a>
      </li>
      <li>
        <a class="follow-sina" rel="nofollow" target="_blank" href="http://weibo.com/shophuawei">
          <img src="/wwwroot/Public/Dist/images/follow_sina.png">
        </a>
      </li>
      <li>
        <a class="follow-qzone" target="_blank" href="http://user.qzone.qq.com/2305534418">
          <img alt="关注QQ空间" src="/wwwroot/Public/Dist/images/follow_qzone.png">
        </a>
      </li>
      <li class="" onmouseover="this.className='hover'" onmouseout="this.className=''">
        <a class="follow-android" href="javascript:;">
          <img src="/wwwroot/Public/Dist/images/follow_android.png" alt="下载手机客户端">
        </a>
      </li>
      <div class="follow-panel follow-panel-qrcode">
        <img src="/wwwroot/Public/Dist/images/img67.png">
        <p>
          <b>扫描二维码下载</b>
        </p>
        <s></s>
      </div>  
    </ul>
  </div>
</div>

<!--品质-->
<div class="slogan">
  <ul>
    <li class="s1">
      <i></i>
      500强企业 品质保证
    </li>
    <li class="s2">
      <i></i>
      7天退货 15天换货
    </li>
    <li class="s3">
      <i></i>
      99元起免运费
    </li>
    <li class="s4">
      <i></i>
      448家维修网点 全国联保
    </li>
  </ul>
</div>

<!--底部-->
<!--
<div class="service">
  <dl class="s1">
    <dt>
      <i></i>
      帮助中心
      </dt>
    <dd>
      <ol>
      
      </ol>
    </dd>
  </dl>
</div>
-->
</body>
</html>