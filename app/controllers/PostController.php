<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 16:24
 */

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public $error;

    public function add(){
        return $this->view('add');
    }

    public function store(){

        $data = [
            'name' => $_POST['name'],
            'text' => $_POST['text'],
            'image' => $this->saveImg()
        ];

        $post = new Post();

        $result = $post->create($data);

        if($result){
            return true;
        } else {
            return $this->view('add', ['errors' => $this->error]);
        }
    }
    
    public function edit(){
        $post = new Post();
        $post = $post->getPostById($this->params['id']);
        return $this->view('edit', ['post' => $post]);
    }
    
    public function update(){

        $post = new Post();
        $post = $post->getPostById($_POST['id']);
        
        $data = [
            'id' => $_POST['id'],
            'name' => !empty($_POST['name']) ? $_POST['name'] : $post['name'],
            'text' => !empty($_POST['text']) ? $_POST['text'] : $post['text'],
            'image' => !empty($_FILES['upload']) ? $this->saveImg() : $post['image']
        ];

        $post = new Post();

        $result = $post->update($data);

        if($result){
            return true;
        }
    }
    
    
    public function show(){
        
        $post = new Post();
        $post = $post->getPostById($this->params['id']);

        if(empty($post)){
            $this->redirect('/');
        }
        
        return $this->view('show', ['post' => $post]);

    }

    public function delete(){
        $post = new Post();
        $result = $post = $post->delete($_POST['id']);

        if($result){
            return true;
        }
    }


    public function saveImg(){

        $filePath  = $_FILES['upload']['tmp_name'];
        $errorCode = $_FILES['upload']['error'];
        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
            // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            // Выведем название ошибки
            $this->error[] = $outputMessage;
            return false;
        }
        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        // Получим MIME-тип
        $mime = (string) finfo_file($fi, $filePath);
        // Закроем ресурс
        finfo_close($fi);
        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false){
            $this->error[] = 'Можно загружать только изображения.';
            return false;
        }
        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($filePath);
        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);
        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);
        // Переместим картинку с новым именем и расширением в папку /pics
        if (!move_uploaded_file($filePath, ROOT.'/public/pics/' . $name . $format)) {
            $this->error[] = 'При записи изображения на диск произошла ошибка.';
            return false;
        }

        return '/public/pics/' . $name . $format;
    }

}