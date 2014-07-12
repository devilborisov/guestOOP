<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:50
 * To change this template use File | Settings | File Templates.
 */

class pageData {
    /**
     * Получаем общее количество страниц
     * @param $count количество строк в файле
     * @param $size сколько строк выводится за раз на странице
     * @return int сколько будет всего страниц
     */
    public static function getCountPage($count, $size){
        $tmp = $count/$size;
        return ((int)$tmp == $tmp) ? $tmp : $tmp + 1;
    }

    /**
     * Выводит срез страниц
     * @param $storage массив со строками
     * @param $pageNum номер требуемой страницы
     * @param $pageSize количество выводимых строк на странице
     * @return array требуемые строки на странице
     */
    public static function getNumPage($storage, $pageNum, $pageSize){
        $startIndex = ($pageNum - 1)*$pageSize;
        return array_slice($storage, $startIndex, $pageSize);
    }
}