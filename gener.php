<?php   
   
    require_once 'src/Base.php';
    
    
    //генерация токена для короткой ссылки
	function token_gen($min = 5, $max = 8) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDFEGHIJKLMNOPRSTUVWXYZ0123456789';
		$new_chars = str_split($chars);

		$token = '';
		$rand_end = mt_rand($min, $max);

		for ($i = 0; $i < $rand_end; $i++) {
			$token .= $new_chars[ mt_rand(0, sizeof($new_chars) - 1) ];
		}

		return $token;
	}    
    
    
    //записиь короткой ссылки в БД и получение информации из БД
	if(isset($_GET['link_original'])){
		$link_original = $_GET['link_original'];
		$token = token_gen();
		$db -> insert('links', ['link_original', 'link_shortener', 'date'], [$link_original, $token, time()]);
		
		$row = $db->getRowByWhere('links', 'link_shortener = ?', [$token]);
		$link_shortener = $_SERVER['SERVER_NAME'].'/'.$row['link_shortener'];
			
		echo json_encode($row);

	}

    //возврат всех записей из БД при загрузке страницы
	else if(isset($_POST['empty'])){
		$rows = $db->getRows('links');
        
		echo json_encode($rows);
	}


    //У Д А Л Е Н И Е   С Т Р О К И
    else if(isset($_POST['link_delet'])){
        $del_prefix = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/';
        $link_delet = str_replace($del_prefix, '', $_POST['link_delet']);       
        $db->delete('links', 'link_shortener = ?', [$link_delet]);
        
        $rows = $db->getRows('links');
        echo json_encode($rows);
    }	
	
    //переходы по коротким ссылкам
	else{
		$URI = $_SERVER['REQUEST_URI'];
		$token = substr($URI, 1);
		$row = $db->getRowByWhere('links', 'link_shortener = ?', [$token]);
		header("Location: " . $row['link_original']);
	}
	
    
?>    
  
