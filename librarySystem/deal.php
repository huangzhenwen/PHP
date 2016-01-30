<?php
///////// 业务处理 ////////

//1.接受方法act
$act = isset($_GET['act']) ? $_GET['act'] : '';


if ($act == 'add') {
///////////// 进行新增操作 //////////

	//1、接受数据
	$id = $_POST['id'] ? $_POST['id'] : 0; //编号id
	if(!$id){ header('refresh:1;url=add.php');} //判断是否接受到编号id

	$sort = $_POST['sort'] 		? 		trim($_POST['sort']) 			: '';
	$cover = $_POST['cover'] 	? 		trim($_POST['cover']) 			: 'images/1.png';
	$author = $_POST['author'] 	? 		trim($_POST['author']) 			: '';
	$title = $_POST['title'] 	? 		trim($_POST['title']) 			: '';
	$publication = $_POST['publication'] ? $_POST['publication'] 	: '';
	$isbn = $_POST['isbn'] 		? 		trim($_POST['isbn']) 			: '';
	$price = $_POST['price'] 	? 		trim($_POST['price']) 			: '';

	//2.解析XML
	$dom = new DOMDocument('1.0','UTF-8');
	$dom->load('libray.xml'); //加载xml

	//3.创建节点
	$book = $dom->createElement('book');	//<book>节点	父节点
	$sort = $dom->createElement('sort',$sort);	//<sort>节点
	$cover = $dom->createElement('cover',$cover);	//<cover>节点
	$author = $dom->createElement('author',$author);	//<author>节点
	$title = $dom->createElement('title',$title);	//<title>节点
	$publication = $dom->createElement('publication',$publication);	//<publication>节点
	$isbn = $dom->createElement('isbn',$isbn);
	$price = $dom->createElement('price',$price);

	//4.为book增加id属性
	$book->setAttribute('id',$id);

	//5.追加节点
	$book->appendChild($sort);
	$book->appendChild($cover);
	$book->appendChild($title);
	$book->appendChild($author);
	$book->appendChild($publication);
	$book->appendChild($isbn);
	$book->appendChild($price);

	//6.获取根元素
	$root = $dom->documentElement;
	$root->appendChild($book);//将<book>节点追加到根元素下

	//7.保存xml
	$dom->save('libray.xml');

	//8.判断是否新增成功,成功则回到首页
	if($dom){
		header('location:index.php');
	}else{
		header('location:add.php');
	}

}elseif($act == 'edit'){
	///////////  修改操作 /////////////////
	//1。接受要修改的图书的id
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	if (!$id) {
		echo "<script language='javascript'>alert('参数错误');window.history.back();</script>";
	}

	//2.接受数据
	$sort = $_POST['sort'] 		? 		trim($_POST['sort']) 			: '';
	$cover = $_POST['cover'] 	? 		trim($_POST['cover']) 			: 'images/1.png';
	$author = $_POST['author'] 	? 		trim($_POST['author']) 			: '';
	$title = $_POST['title'] 	? 		trim($_POST['title']) 			: '';
	$publication = $_POST['publication'] ? $_POST['publication'] 		: '';
	$isbn = $_POST['isbn'] 		? 		trim($_POST['isbn']) 			: '';
	$price = $_POST['price'] 	? 		trim($_POST['price']) 			: '';

	//3.解析xml
	//$dom = new DOMDocument('1.0','UTF-8'); //放弃使用PHP DOM模式
	$xml = simplexml_load_file('libray.xml');
	//4.获取这些元素对应的父元素
	$book = $xml->xpath("/libray/book[@id='$id']");
	//5.更新元素
	$book[0]->sort = $sort;
	$book[0]->cover = $cover;
	$book[0]->author = $author;
	$book[0]->title = $title;
	$book[0]->publication = $publication;
	$book[0]->isbn = $isbn;
	$book[0]->price = $price;

	//保存XML
	$res = $xml->asXML('libray.xml');

	//判断是否更新成功
	if($res){
		//成功
		header('location:index.php');
	}else{
		//失败
		header("location:edit.php?id={$id}");
	}
}elseif($act == 'delete'){
	///////////  删除图书信息 /////////
	
	//1.接受要被删除的id
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	if (!$id) {
		echo "<script language='javascript'>alert('参数错误');window.history.back();</script>";
	}

	//2、解析XML
	$dom = new DOMDocument('1.0','UTF-8');
	$dom->load('libray.xml');
	
	//3.获取父节点	
	$root = $dom->documentElement;

	//4.获取全部book元素
	$books = $dom->getElementsByTagName('book');

	//方法：获取所有book元素的id属性值与$id匹配，记录循环的次数。匹配成功后，将记录数减1，作为item(记录数)，获取对应的元素，最后删除。
	for($i=0; $i<$books->length; $i++){

		if($id ==  $books->item($i)->getAttribute('id') ){

			//匹配成功，删除节点
			$root->removeChild($books->item($i));
			//保存XML
			$dom->save('libray.xml');

			header('location:index.php');
			return ;//终止循环。
		}

	}


}