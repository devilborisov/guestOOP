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
// Подключаем шаблоны главной страницы, формы и сообщений
$pageTpl =$tample::getTemplate('page');
$form = $tample::getTemplate('form');
$msg = "";
$message =$tample::getTemplate('message');
// Получаем данные из формы

$formD=$formData::getData();

// Проверка данных отправленных в форму
if($formValid::isFormSubmitted()){
    $valid = $formValid::validateForm($formD);
    // Если форма не прошла проверку, то выводим сообщение об ошибках
    if($valid !== true) {
        $form = $formValid::processTemplateErrorOutput($form, $valid);
    } else {
        if($msgSave::saveMessage($formD)){
            header('Location: '.$_SERVER['REQUEST_URI']);
        } else {
            $msg = 'Ошибка сохранения';
        }

    }
}

// Получаем данные из файла
$storage = $formData::getStorage('data/data.txt');
$storageSize = $formData::getStorageSize($storage);

// Номер текущей страницы
$pageNum = isset($_GET['page']) ? (int)$_GET['page']: 1;

// Количество выводимых сообщений на странице
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize']: 10;
$pageCount = $dataPage::getCountPage($storageSize, $pageSize);
$pageItem =$dataPage:: getNumPage($storage, $pageNum, $pageSize);

// Получаем данные для формы, страницы и сообщений и выводим все
$form = $tample::contentTemplate($form, $formD);
$page = $tample::contentTemplate($pageTpl, array(
    'FORM' => $form,
    'CAPCHA' => $captchaGen::generateCapcha(),
    'MSG' => $msg,
    'MESSAGE'=> $msgSave::getHtmlMessage($pageItem, $message),
    'PAGINATOR' => $pagintorGen::getPaginatorHtml($pageCount)
));

echo $page;