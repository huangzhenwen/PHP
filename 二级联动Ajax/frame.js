/**
 * Ajax框架
 */
//自调用匿名函数
(function(){

//定义对象$,获取DOM对象
var $ = function(id){	return document.getElementById(id);	};

//创建Ajax对象方法
$.init = function(){
	try{	return new XMLHttpRequest();	} catch(e) {}					//返回w3c浏览器的Ajax对象
	try{	return new ActiveXObject('Mircosoft.XMLHTTP');	} catch(e) {}	//返回IE8下浏览器的AJax对象
	alert('尊敬的客户，您的浏览器不支持Ajax，请更换!');
};

//创建get请求
/**
 * @param string 	url		请求页面地址
 * @param string 	data	请求参数,形如：'name=zhangsna&age=23'
 * @param object	callback 匿名函数
 * @param string 	type 	返回值类型:text,xml,json
 */
$.get = function(url, data, callback, type){
	//1	创建Ajax对象
	var xhr = $.init();
	//2	设置回调函数
	xhr.onreadystatechange = function(){
		//5 判断与执行
		if(xhr.readyState==4 && xhr.status==200){
			if(type == null)	{ type='text';	}
			if(type == 'text')	{ callback(xhr.responseText);	}
			if(type == 'xml')	{ callback(xhr.responseXML);	}
			if(type == 'json')	{ callback( eval( '(' + xhr.responseText + ')' ) );	}
		}
	};
	//3	判断有无参数,组装地址与参数
	if(data != null){	url = url + '?' + data; 	}
	//4	初始化Ajax对象
	xhr.open('get',url);
	//	设置缓存
	xhr.setRequestHeader('If-Modified-Since','0');
	//5	发送请求
	xhr.send(null);	
};

//post请求
/**
 * @param string 	url		请求页面地址
 * @param string 	data	请求参数,形如：'name=zhangsna&age=23'
 * @param object	callback 匿名函数
 * @param string 	type 	返回值类型:text,xml,json
 */
$.post = function(url,data,callback,type){
	//Ajax对象
	var xhr = $.init();
	xhr.onreadystatechange = function(){
		if(xhr.readyState==4 && xhr.status==200){
			if(type == null) { type = 'text'; }
			
			if(type == 'text') { callback( xhr.responseText ); }
			if(type == 'xml') { callback( xhr.responseXML ); }
			if(type == 'json') { eval( '(' + xhr.responseText + ')'  ); }
		}
		
	};
	xhr.open('post',url);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xhr.setRequestHeader('If-Modified-Since','0');
	xhr.send(data);
	
};

window.getIdDom = window.$ = $;
	
})();
