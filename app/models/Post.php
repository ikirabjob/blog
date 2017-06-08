<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 16:13
 */

namespace App\Models;

use Core\Model;

class Post extends Model
{
    public function getPostById($id){
        return $this->get_('SELECT * FROM `posts` WHERE `id`=:id', 0, ['id' => $id]);
    }

    public function getPostsList(){
        return $this->get_('SELECT * FROM `posts`', 1);
    }

    public function create($data = []){

        if(!empty($data)){

            $result = $this->insert_("INSERT INTO `posts` SET `name` = :name, `text` = :text, `image` = :image, `created_at` = :created_at, `updated_at` = :updated_at", [
                ':name' => $data['name'],
                'text' => $data['text'],
                ':image' => $data['image'],
                ':created_at' => date('Y-m-d H:i:s', time()),
                ':updated_at' => date('Y-m-d H:i:s', time())
            ]);

            if($result){
                return $this->lastId();
            }

        }


        return false;
    }

    public function update($data){
        if(!empty($data)){

            $result = $this->update_("UPDATE `posts` SET `name` = :name, `text` = :text, `image` = :image, `updated_at` = :updated_at WHERE `id` = :id", [
                ':id' => $data['id'],
                ':name' => $data['name'],
                ':text' => $data['text'],
                ':image' => $data['image'],
                ':updated_at' => date('Y-m-d H:i:s', time())
            ]);

            if($result){
                return $this->lastId();
            }

        }


        return false;
    }
    
    public function delete($id){
        return $this->delete_("DELETE FROM `posts` WHERE `id` = :id", ['id' => $id]);
    }
}