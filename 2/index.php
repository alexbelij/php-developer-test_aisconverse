<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Загрузка изображения и наложение текста на него</title>
 </head>
 <body>
  <form enctype="multipart/form-data" method="post" action="watermark.php">
   <p>Введите текст и загрузите вашу фотографии на сервер</p>
   <p>
   <label for="name">Текст для наложения&nbsp;&nbsp;<input type="text" name="text" id="name"/></label><br/>
   <label for="image">Исходное изображение (jpeg,png,gif)&nbsp;&nbsp;<input type="file" name="image" id="image" accept="image/*,image/jpeg,image/png,image/gif"/></label><br/></p>
   <p><input type="submit" value="Отправить"/></p>
  </form> 
 </body>
</html>