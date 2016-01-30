//定义函数：返回DOM对象
function $(id) {
	return document.getElementById(id);
}

//封装阻止默认行为
function stopReturn(event) {
	//判断浏览器
	if (window.event) {
		//IE
		window.event.returnValue = false;
	} else {
		//W3C
		event.preventDefault();
	}
}


//阻止事件冒泡
/*
	@param object event 事件对象
 */
function stopBubble(event) {

	//判断浏览器
	if( window.event ){
		//IE
		window.event.cancelBubble = true;
	}else{
		//W3C
		event.stopPropagation();
	}
}


/**
 * 封装监听机制，兼容不同浏览器
 * @param  object	obj 	 dom对象
 * @param  string   type     不带前缀‘on’的事件句柄，如：click,mouseover
 * @param  Function callback 函数地址
 * @return 
 */
function addListener(obj,type,callback) {

	//判断当前浏览器类型
	if (obj.addEventListener) {
		//W3C浏览器：由于addEventListener是一个属性，它保存了函数的地址。
		//如果是W3C浏览器调用，则为真，否则为假
		obj.addEventListener(type,callback);
		
	}else{
		//IE8和IE8以下浏览器
		obj.attachEvent('on'+type, callback);
	}

}

/**
 * 移除监听机制，兼容不同浏览器
 * @param  object   obj      	DOM对象
 * @param  string   type      	事件句柄，不带前缀’on‘
 * @param  string   callback  	有名函数
 */
function removeListener(obj, type, callback) {

	//判断浏览器类型
	
	if(obj.removeEventListener){
		//W3C
		obj.removeEventListener(type,callback);
	}else{
		//IE8以下
		obj.detachEvent( 'on'+type, callback);
	}

}