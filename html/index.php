
    <script>
    
    
    //функция разбиения длинных ссылок  
   
function transfer(str){
    let token = 70;
    let new_str = '';
    
    for (let i = 0; i < str.length; i++){   
        new_str += str[i];
        if((i % token) == 0){
            new_str += '\n';
        }
    }
    return new_str;
} 
    		
            
			function success(data){
				
				let str_row = JSON.parse(data);
				console.log(str_row);
				
				let link_shortener = str_row['link_shortener'];
				let link_original = str_row['link_original'];
				let date = str_row['date'];
                				
				$('input[type="text"]').val('<?=$_SERVER['REQUEST_SCHEME'].':\/\/'.$_SERVER['SERVER_NAME'].'/'?>'+link_shortener);

                let date_int = new Date(date*1000);
					
				let Month =(Number(date_int.getMonth())+1 < 10)? ('0'+(Number(date_int.getMonth())+1)):(Number(date_int.getMonth())+1);
				let Hour = (Number(date_int.getHours()) < 10)? ('0'+(Number(date_int.getHours()))):(Number(date_int.getHours()));
				let Minutes = (Number(date_int.getMinutes()) < 10)? ('0'+(Number(date_int.getMinutes()))):(Number(date_int.getMinutes()));
				let Seconds = (Number(date_int.getSeconds()) < 10)? ('0'+(Number(date_int.getSeconds()))):(Number(date_int.getSeconds()));
					
                date_int = 'Ссылка создана: ' + date_int.getDate()+ '.' + Month + '.' + date_int.getFullYear() + ' в ' + Hour + ':' + Minutes + ':' + Seconds;				
				
				
				$('.top').after('<div class="block right bottom"><h3>Ваша сокращенная ссылкa</h3><div class="recently_shortened_link"><div class="qr_cod"><img src="../images/qr_cod.png" alt="qr_cod" /><p><a href="#">Показать</a></p></div><div class="info_link"><p class="one"><a target="_blank" class="short_link" href="'+link_shortener+'"><?=$_SERVER['REQUEST_SCHEME'].':\/\/'.$_SERVER['SERVER_NAME'].'/'?>'+link_shortener+'</a></p><p class="two two2"><span class="two">'+transfer(link_original)+'</span></p><p class="two">'+date_int+'</p></div><div class="delet">X</div></div></div>');		
			}
			
			function before(){
				console.log('Обработка');
			}
			


            // получение оригинальной ссылки       
      
                //обращаемся к форме, событие "отправка формы" и далее функция
                $(document).on('submit', 'form', function(e) {                
                    e.preventDefault(); //запрещаю базовую обработку события
                    let form = $(e.target); //записываю в перем. обращение к сойству объекта, которое указывает на элемент на котором произошло событие
                    let link_original = $('input[type="text"]').val(); //записываю в перем. нашу ссылку 
                    $.ajax({
                        url: '../gener.php',
                        type: 'GET',
                        data: ({link_original: link_original}),
                        dataType: 'text',
                        beforeSend: before,
                        success: success
                    });
                });


			// получение всех строк таблицы
						
            function beforeLoad(){
                $('.short_link').text('Ожидание данных ...');
            }
            
            function error(){
                $('.short_link').text('Ошибка загрузки данных ...');              
            }
            
            function successLoad(data){
                
				
                let links = JSON.parse(data);
                
                
                for(let info_link of links){
					
                    let date_int = new Date(info_link['date']*1000);
					
					let Month =(Number(date_int.getMonth())+1 < 10)? ('0'+(Number(date_int.getMonth())+1)):(Number(date_int.getMonth())+1);
					let Hour = (Number(date_int.getHours()) < 10)? ('0'+(Number(date_int.getHours()))):(Number(date_int.getHours()));
					let Minutes = (Number(date_int.getMinutes()) < 10)? ('0'+(Number(date_int.getMinutes()))):(Number(date_int.getMinutes()));
					let Seconds = (Number(date_int.getSeconds()) < 10)? ('0'+(Number(date_int.getSeconds()))):(Number(date_int.getSeconds()));
					
                    date_int = 'Ссылка создана: ' + date_int.getDate()+ '.' + Month + '.' + date_int.getFullYear() + ' в ' + Hour + ':' + Minutes + ':' + Seconds;
                                      
					
                $('.top').after('<div class="block right bottom"><h3>Ваша сокращенная ссылкa</h3><div class="recently_shortened_link"><div class="qr_cod"><img src="../images/qr_cod.png" alt="qr_cod" /><p><a href="#">Показать</a></p></div><div class="info_link"><p class="one"><a target="_blank" class="short_link" href="'+info_link['link_shortener']+'"><?=$_SERVER['REQUEST_SCHEME'].':\/\/'.$_SERVER['SERVER_NAME'].'/'?>'+info_link['link_shortener']+'</a></p><p class="two two2"><span class="two">'+transfer(info_link['link_original'])+'</span></p><p class="two">'+date_int+'</p></div><div class="delet">X</div></div></div>');
				}
            }				
				
				
            //после прогрузки страницы        
            $(document).ready(function(){
                    $.ajax({
                        url: 'gener.php',
                        type: 'POST',
                        data: ({empty: 'empty'}),
                        dataType: 'text',
                        beforeSend: beforeLoad,
                        success: successLoad,
                        error: error
                    });
            });				


            
            // Ф У Н К Ц И И   У Д А Л Е Н И Я
        function successDelete(data){
                $('.bottom').remove();
                
                
               let links = JSON.parse(data)
               
                for(let info_link of links){
					
                    let date_int = new Date(info_link['date']*1000);
					
					let Month =(Number(date_int.getMonth())+1 < 10)? ('0'+(Number(date_int.getMonth())+1)):(Number(date_int.getMonth())+1);
					let Hour = (Number(date_int.getHours()) < 10)? ('0'+(Number(date_int.getHours()))):(Number(date_int.getHours()));
					let Minutes = (Number(date_int.getMinutes()) < 10)? ('0'+(Number(date_int.getMinutes()))):(Number(date_int.getMinutes()));
					let Seconds = (Number(date_int.getSeconds()) < 10)? ('0'+(Number(date_int.getSeconds()))):(Number(date_int.getSeconds()));
					
                    date_int = 'Ссылка создана: ' + date_int.getDate()+ '.' + Month + '.' + date_int.getFullYear() + ' в ' + Hour + ':' + Minutes + ':' + Seconds;
                                      
					
                $('.top').after('<div class="block right bottom"><h3>Ваша сокращенная ссылкa</h3><div class="recently_shortened_link"><div class="qr_cod"><img src="../images/qr_cod.png" alt="qr_cod" /><p><a href="#">Показать</a></p></div><div class="info_link"><p class="one"><a target="_blank" class="short_link" href="'+info_link['link_shortener']+'"><?=$_SERVER['REQUEST_SCHEME'].':\/\/'.$_SERVER['SERVER_NAME'].'/'?>'+info_link['link_shortener']+'</a></p><p class="two two2"><span class="two">'+transfer(info_link['link_original'])+'</span></p><p class="two">'+date_int+'</p></div><div class="delet">X</div></div></div>');
				}
            }                
                             
                
       

        function beforeDelete(){
                console.log('Идёт передача данных');
        }
        
        function errorDelete(){
                console.log('Ошибка передачи данных');
        }            
            
            
            
            
            // У Д А Л Е Н И Е    Э Л Е М Е Н Т А
            $(document).ready(function(){
                $(document).on('click', '.delet', function(e){
                    let link_delet = $('.short_link').html();
                    $elem = e.target;
                    
                    
                        $.ajax({
                        url: 'gener.php',
                        type: 'POST',
                        data: ({link_delet: link_delet}),
                        dataType: 'text',
                        beforeSend: beforeDelete,
                        success: successDelete,
                        error: errorDelete
                    }); 
                    
                });
            });
          
    </script>
  	
			<!-- Правый в е р х н и й БЛОК -->
			
        
            <div class="block right top">
                <h1>Мой личный сократитель ссылок</h1>
                <div class="text">
                    <div class="text_1">Здесь можно сделать из длинной и сложной ссылки простую.</div>
                    <div class="text_1">Этими ссылками удобнее будет делиться пользователям моего будующего сайта между собой.</div>
                </div>
                <form name="form" action="#" method="post">
                    <input type="text" placeholder="Cсылка, которую вы хотите сократить" />
                    <input type="submit" value="Сократить"/>
                    <div class="clear"></div>
                </form>   
            </div>

			<!-- Правый н и ж н и е БЛОКИ добаляются автоматически-->
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
		