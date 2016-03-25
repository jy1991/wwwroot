$(document).ready(function(){
  //我的商城 购物车	
  $(".i-mall .h a").hover(function(){
    $(".i-mall .b").show();
	$(".minicart .b").hide();
	$(".i-mall .h").css('border-bottom','solid 1px #fff');
	$(".minicart .h").css('border-bottom','solid 1px #e5e5e5');
  });
  $(".minicart .h a").hover(function(){
	$(".minicart .b").css('left','-370px');
	$(".minicart .b").css('top','31px');
    $(".minicart .b").show();
	$(".i-mall .b").hide();
	$(".minicart .h").css('border-bottom','solid 1px #fff');
	$(".i-mall .h").css('border-bottom','solid 1px #e5e5e5');
  });  
  $(".header-toolbar .b").mouseleave(function(){
    $(".header-toolbar .b").hide();
	$(".h").css('border-bottom','solid 1px #e5e5e5');
  });
  
  //二维码
  $("#ec-erweima .ec-slider-list .ec-slider-item").hidden();
  
/*
  $(function () {
	  $('#naver-list li').hover(function () {
		  $(this).addClass('hover');
	  },function () {
		  $(this).removeClass('hover');
	  });
  });
*/

});

(function () {
	//所有分类显示隐藏控制
	var isIndex =  true ,
		categoryBlock = gid('category-block');
		
	if(isIndex) return;
	
	$("#category-block").hover(function(){
		$(this).addClass("category-hover");
	},function(){
		$(this).removeClass("category-hover");
	});
	
	/*categoryBlock.onmouseover = function () {
		categoryBlock.className = 'category category-hover';
	};
	categoryBlock.onmouseout = function () {
		categoryBlock.className = 'category';
	};*/
	
}());

/**
*功能：给鼠标移动到category-list li上面的时候，记得给他多添加一个hover类样式
*目的是兼容ie6,以及调整二级分类的弹出框的位置。
*@author 李峰
*/
/**
$(function(){
	$(".category-item").hover(function(){
		$(this).addClass("hover");
		//1.二级分类的top值
		var childrenTop = $(this).offset().top;
		//2.一级分类的top值
		var parentTop = $(".category-list").offset().top;
		//3.二级分类到一级分类顶部的距离
		var top = childrenTop - parentTop;
		//4.二级分类的弹出层的高度
		var childrenHeight = $(this).find(".category-panels").innerHeight();
		//5.一级分类容器的总高度
		var totalHeight = $(".category-list").height();
		alert("childrenTop:"+childrenTop+";parentTop:"+parentTop+";top:"+top+";childrenHeight:"+childrenHeight+";totalHeight:"+totalHeight) ;

		//6.如果二级分类.category-panels的内容高度大于总容量totalHeight,那么.category-panels置顶，然后多余的自动往下延续
		//如果二级分类childrenHeight内容高度(childrenHeight + top )大于totalHeight,那么.category-panels往上移动childrenHeight + top -totalHeight
		if((top + childrenHeight) > totalHeight)
		{
			if(childrenHeight > totalHeight)
			{
				$(this).find(".category-panels").css("top",-top);
			}else{
				//上移动
				var topX = (childrenHeight+top) - totalHeight;
				$(this).find(".category-panels").css("top",-topX);
				
			}
			
		}
		
	},function(){
		$(this).removeClass("hover");
	});
});
 */

ec.load("ec.slider", {
   loadType : "lazy",
   callback : function() {
	$("#index_slider").slider({
		   width:     '100%', //必须
		   height:     448, //必须
		   style : 1,                    //1显示分页，2只显示左右箭头,3两者都显示
		   pause : 5000,           //间隔时间
		   auto : true,
		   minWidth : 1200,
		   showNumber:true,
		   circleBtn:true
	});
   }
});

	ec.load("ec.slider", {
		loadType : "lazy",
		callback : function() { 
			$("#group-slider").slider({
				sliderType : "left",
				auto: false,
				width: 276, //　必须
				height: 310,　 //　必须
				style : 2, //　1显示分页，2只显示左右箭头,3两者都显示
				pause : 5000 //　间隔时间
			});
		}
	});