<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 12:36
 */

namespace Core;


class View {
    // получить отрендеренный шаблон с параметрами $params
    protected function fetchPartial($template, $params = array()){
        extract($params);
        ob_start();
        include VIEWS_BASEDIR.$template.'.php';
        return ob_get_clean();
    }

    // вывести отрендеренный шаблон с параметрами $params
    public function renderPartial($template, $params = array()){
        echo $this->fetchPartial($template, $params);
    }

    // получить отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params
    protected function fetch($template, $params = array()){
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('layout', array('content' => $content));
    }

    // вывести отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params    
    public function render($template, $params = array()){
        echo $this->fetch($template, $params);
    }
}