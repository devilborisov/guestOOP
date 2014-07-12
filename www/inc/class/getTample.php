<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:35
 * To change this template use File | Settings | File Templates.
 */

 class getTample {
    /**
     * Возвращает  шаблон по его имени, если он найден в папке шаблонов. иначе - пустую строку
     * @param $name string - имя шаблона
     * @return string
     */
    public static  function getTemplate($template){
        $tpl = "";
        $template = 'tpl/'. $template . '.html';
        if(file_exists($template)){
            $tpl = file_get_contents($template);
        }
        return $tpl;
    }

    /**
     * Выполняет подстановки в переданный шаблон
     * @param $tpl string - строка с макросами подстановки вида {{NAME}}
     * @param array $data - массив подстановок вида array('NAME' => 'code')
     * @return string
     */
    public static  function contentTemplate($tpl, array $data = array()){
        foreach($data as $key => $val){
            $tpl = str_replace('{{'.$key.'}}', $val, $tpl);
        }
        return $tpl;
    }
}