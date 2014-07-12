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
     * �������� ����� ���������� �������
     * @param $count ���������� ����� � �����
     * @param $size ������� ����� ��������� �� ��� �� ��������
     * @return int ������� ����� ����� �������
     */
    public static function getCountPage($count, $size){
        $tmp = $count/$size;
        return ((int)$tmp == $tmp) ? $tmp : $tmp + 1;
    }

    /**
     * ������� ���� �������
     * @param $storage ������ �� ��������
     * @param $pageNum ����� ��������� ��������
     * @param $pageSize ���������� ��������� ����� �� ��������
     * @return array ��������� ������ �� ��������
     */
    public static function getNumPage($storage, $pageNum, $pageSize){
        $startIndex = ($pageNum - 1)*$pageSize;
        return array_slice($storage, $startIndex, $pageSize);
    }
}