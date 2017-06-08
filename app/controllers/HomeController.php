<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 14:51
 */

namespace App\Controllers;

use Core\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){

        $post = new Post();

        return $this->view('main', ['posts' => $post->getPostsList()]);
    }
}