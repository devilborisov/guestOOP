<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:45
 * To change this template use File | Settings | File Templates.
 */

class messageData extends  getTample {
    /**
     * Сохранение данных в базе данных
     * @param array $msgData массив с данными
     * @return string
     */
    public static function saveMessage(array $msgData){
        $str = implode(" [***] ", $msgData);
        file_put_contents("data/data.txt", $str."\n",FILE_APPEND | LOCK_EX);
        return $str;
    }
    /**
     * Получаем html код для сообщений
     * @param $pageItem массив с сообщениями
     * @param $message html шаблон для сообщений
     * @return string html код сообщений
     */
    public static function getHtmlMessage($pageItem, $message){
        $messages = "";
        foreach($pageItem as $str){
            $item = self::parseItems($str);
            $messagetpl =self::contentTemplate($message, array(
                'USER' => $item['userName'],
                'EMAIL' => $item['userEmail'],
                'TIME' => $item['time'],
                'MESSAGE' => $item['userMsg']
            ));
            $messages .= $messagetpl;
        }
        return $messages;
    }
    /**
     * Получаем данные об одном пользователе
     * @param $str данные строки с файла
     * @return array получаем массив с данными пользователя
     */
    public static  function parseItems($str){
        $arr = array();

        $tmp = explode(' [***] ', $str);
        $arr['userName'] = $tmp[0];
        $arr['userEmail'] = $tmp[1];
        $arr['userMsg'] = $tmp[2];
        $arr['time'] = $tmp[4];
        $arr['userAgent'] = $tmp[5];
        $arr['ip'] = $tmp[6];
        return $arr;
    }
}