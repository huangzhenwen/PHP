/**
 * Ajax框架
 * 通过自调用匿名函数函数加载框架,圆括号的优先级最高，可以通过圆括号保证先执行匿名函数
 * 
 * 1、保证效率---闭包
 * 	全局变量指向局部变量，保证局部变量能在全局使用，且不被释放，却无需向上查找局部变量。
 * 2、所有变量都是对象 --- 一个对象，多个属性(函数)
 * 	为局部变量添加属性，属性指向了匿名函数，函数中定义了所需的功能。最终，实现了通过对象调用属性来实现更多的功能。
 * 3、结果的返回(callback) --- 函数首地址	---- 同一块内存
 *  callback接受匿名函数地址，将结果(xhr.responseText)作为实参赋给callback(),完成结果的传递
 */
//0 自调用匿名函数
(function (){
//1 定义局部变量$，指向函数地址，实现通过id获取dom对象的功能
var $ = function(id){ return document.getElementById(id); };

//2 定义Ajax对象创建方法
$.init = function(){
	try { return new XMLHttpRequest();} catch(e) {}
	try { return new ActiveXObject('Mircosoft.XMLHTTP'); } catch(e) {} 
	alert('尊敬的用户，您的浏览器不支持Ajax，请更换！');
};

//3 定义get请求
/**
 * @param string 	url 		get请求页面
 * @param string 	data 		get请求的参数，样式：'name=lisi&age=23&sex=男'
 * @param object 	callback 	匿名函数
 * @param boolean 	type 		返回值类型，text，json，xml
 */
$.get = function(url, data, callback,type){
	//1 ajax对象
	var xhr = $.init();
	//2	回调函数
	xhr.onreadystatechange = function(){
		//7 判断与执行
		if(xhr.readyState==4 && xhr.status==200){
			//8 判断类型type
			if(type == null)	{ type='text';	}
			if(type == 'text')	{ callback(xhr.responseText);	}
			if(type == 'xml')	{ callback(xhr.responseXML);	}
			if(type == 'json')	{ callback( eval( '(' + xhr.responseText + ')' ) );	}

		}
	};
	//3	判断参数是否存在,若存在则组装地址与参数
	if(data != null){ url = url + '?' + data; }
	//4	设置参数
	xhr.open('get',url);
	//5 解决缓存
	xhr.setRequestHeader('If-Modified-Since','0');
	//6	发送请求
	xhr.send(null);
};


//4 定义post请求
/**
 * @param string 	url 		get请求页面
 * @param string 	data 		get请求的参数，样式：'name=lisi&age=23&sex=男'
 * @param object 	callback 	匿名函数
 * @param boolean 	type 		返回值类型，text，json，xml
 */
$.post = function(url, data, callback,type){
	//1	创建ajax对象
	var xhr = $.init();
	//2	回调函数
	xhr.onreadystatechange = function(){
		if(xhr.readyState==4 && xhr.status==200){
			//6	判断返回值类型type
			if(type == null)	{ type = 'text'; }
			if(type == 'text')	{ callback(xhr.responseText);}
			if(type == 'xml')	{ callback(xhr.responseXML);}
			if(type == 'json')	{ callback( eval( '('+xhr.responseText + ')' ));	}
		}
	};
	//3	初始化ajax对象
	xhr.open('post',url);
	//4	设置请求头
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	//5	发送请求
	xhr.send(data);
};

// 全局变量(window.$)指向局部变量($),
window.getDom = window.$ = $;	//设置多个全局变量，防止变量重名
	
})();
