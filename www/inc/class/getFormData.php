<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:39
 * To change this template use File | Settings | File Templates.
 */

  class getFormData {
    public  static function getData(){
        $arr = array();
        $arr['userName'] = isset($_POST['userName'])? trim($_POST['userName']): '';
        $arr['userEmail'] = isset($_POST['userEmail'])? trim($_POST['userEmail']): '';
        $arr['userMsg'] = isset($_POST['userMsg'])? trim($_POST['userMsg']): $_COOKIE['userMsg'];
        $arr['inputCapcha'] = isset($_POST['inputCapcha'])? trim($_POST['inputCapcha']): '';
        $arr['time'] = date('H:i d.m.Y');
        $arr['userAgent'] = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT']: '';
        $arr['ip'] = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']: '';

        // Сохраняем значения полей в сессии и куки
        if(isset($_POST['userName']) && (!empty($_POST['userName']))){
            $_SESSION['userName'] = $_POST['userName'];
        }
        if(isset($_POST['userEmail']) && (!empty($_POST['userEmail']))){
            $_SESSION['userEmail'] = $_POST['userEmail'];
        }
        if(isset($_POST['userMsg']) && (!empty($_POST['userMsg']))){
            setcookie('userMsg', $_POST['userMsg'], 3600*60*60);
        }
        return $arr;
    }
    /**
     * Получаем данные из файла в виде массива
     * @param $url адрес к файлу
     * @return array возвращает массив данных
     */
    public static function getStorage($url){
        return array_reverse(file($url));
    }

    /**
     * Возвращает размер хранилища(количество строк)
     * @param $storage файл
     * @return int количество строк
     */
    public  static function getStorageSize($storage){
        return count($storage);
    }



}