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
     * ����������  ������ �� ��� �����, ���� �� ������ � ����� ��������. ����� - ������ ������
     * @param $name string - ��� �������
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
     * ��������� ����������� � ���������� ������
     * @param $tpl string - ������ � ��������� ����������� ���� {{NAME}}
     * @param array $data - ������ ����������� ���� array('NAME' => 'code')
     * @return string
     */
    public static  function contentTemplate($tpl, array $data = array()){
        foreach($data as $key => $val){
            $tpl = str_replace('{{'.$key.'}}', $val, $tpl);
        }
        return $tpl;
    }
}