<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:56
 * To change this template use File | Settings | File Templates.
 */

class Paginator {
    /**
     * Вывод пагинатора и переключения режим отображения страниц
     * @param $pages кол-во страниц в зависимости от режима
     * @return string вывод html разметки пагинатора и переключения режимов
     */
    public static function getPaginatorHtml($pages){

        $html = "";
        $html .= "<div class='pagination pagination-centered'><ul>";
        isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
        isset($_GET['pageSize']) ? $pageSize = $_GET['pageSize'] : $pageSize = 10;
        for($i = 1; $i <= $pages; $i++){
            if($page == $i){
                $pageActive = 'active';
            }else{
                $pageActive = 'disable';
            }
            $html .= "<li class='$pageActive'><a href='?page=$i&pageSize=$pageSize'>$i</a></li>";
        }
        switch($pageSize){
            case 10:
                $pageSizeActive1 = "class = 'active'";
                break;
            case 25:
                $pageSizeActive2 = "class = 'active'";;
                break;
            case 50:
                $pageSizeActive3 = "class = 'active'";;
                break;
        }
        $html .= "</ul></div>";
        $html .= "<div class='pagination pagination-centered'><ul>";
        $html .= "<li $pageSizeActive1><a href='?page=1&pageSize=10'>10</a></li>";
        $html .= "<li $pageSizeActive2><a href='?page=1&pageSize=25'>25</a></li>";
        $html .= "<li $pageSizeActive3><a href='?page=1&pageSize=50'>50</a></li>";
        $html .= "</ul></div>";
        return $html;
    }
}