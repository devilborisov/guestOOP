<?php
//error_reporting(E_ALL);
session_start();
require_once("inc/class/baseGB.php");
require_once("inc/class/getTample.php");
require_once("inc/class/getFormData.php");
require_once("inc/class/validForm.php");
require_once("inc/class/messageData.php");
require_once("inc/class/pageData.php");
require_once("inc/class/captcha.php");
require_once("inc/class/Paginator.php");
$pagintorGen=new Paginator();
$captchaGen=new CAPTCHAG();
$dataPage=new pageData();
$msgSave=new messageData();
$formValid=new validForm();
$formData=new getFormData();
$tample=new getTample();
// ���������� ������� ������� ��������, ����� � ���������
$pageTpl =$tample::getTemplate('page');
$form = $tample::getTemplate('form');
$msg = "";
$message =$tample::getTemplate('message');
// �������� ������ �� �����

$formD=$formData::getData();

// �������� ������ ������������ � �����
if($formValid::isFormSubmitted()){
    $valid = $formValid::validateForm($formD);
    // ���� ����� �� ������ ��������, �� ������� ��������� �� �������
    if($valid !== true) {
        $form = $formValid::processTemplateErrorOutput($form, $valid);
    } else {
        if($msgSave::saveMessage($formD)){
            header('Location: '.$_SERVER['REQUEST_URI']);
        } else {
            $msg = '������ ����������';
        }

    }
}

// �������� ������ �� �����
$storage = $formData::getStorage('data/data.txt');
$storageSize = $formData::getStorageSize($storage);

// ����� ������� ��������
$pageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;

// ���������� ��������� ��������� �� ��������
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize']: 10;
$pageCount = $dataPage::getCountPage($storageSize, $pageSize);
$pageItem =$dataPage:: getNumPage($storage, $pageNum, $pageSize);

// �������� ������ ��� �����, �������� � ��������� � ������� ���
$form = $tample::contentTemplate($form, $formD);
$page = $tample::contentTemplate($pageTpl, array(
    'FORM' => $form,
    'CAPCHA' => $captchaGen::generateCapcha(),
    'MSG' => $msg,
    'MESSAGE'=> $msgSave::getHtmlMessage($pageItem, $message),
    'PAGINATOR' => $pagintorGen::getPaginatorHtml($pageCount)
));

echo $page;