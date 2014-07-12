<?php

class validForm  {
    /**
     * ��������� ����� ��������� ��������� ���������, ������� true ��� false, � array ������ ���� �� ������ ��������
     * @param array $form
     * @return bool
     */
    /**
     * ��������� ������������ ��������� �����
     * @return bool
     */
    public static  function checkCaptchaAnswer($answ){
        $rightAnsw = isset($_SESSION['captcha'])? $_SESSION['captcha']: '';
        return $answ == $rightAnsw;
    }
    public static function validateForm(array $formData){
        $validation = true;
        $errors = array();
        if(!preg_match('/^\D{3,} \D{3,}$/', $formData['userName'])){
            $validation = false;
            $errors['userName'] = "��� ������������ ������ ��������� �� ����� 3 �������� � �������� �� ���� ����";
        }
        if(!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',$formData['userEmail'])){
            $validation = false;
            $errors['userEmail'] = "����������� ������ email. ������ ���� ���� example@gmail.com";
        }
        if(strlen($formData['userMsg'])<15){
            $validation = false;
            $errors['userMsg'] = "��������� ������������ ������ ��������� �� ����� 15 ��������";
        }else{
            $_SESSION['userMsg'] = $formData['userMsg'];
        }
        if(self::checkCaptchaAnswer($formData['inputCapcha'])!=true){
            $validation = false;
            $errors['inputCapcha'] = "������������ �����";
        }
        if(!$validation){
            return $errors;
        }else{
            return $validation;
        }


    }
    /**
     * ��������� ���� �� ���������� �����
     * @return bool
     */
    public static function isFormSubmitted(){
        return (isset($_POST) AND !empty($_POST));
    }
    /**
     * ������� ��������� �� ������� � ���������� ������
     * @param $tpl - ������� html
     * @param array $data
     * @return string
     */
    public static function processTemplateErrorOutput($tpl, array $data = array()){
        foreach($data as $key => $val){
            $tpl = str_replace(
                "<p class=\"help-block\" data-name=\"$key\"></p>",
                "<div class='alert alert-error'><p class=\"help-block\" data-name=\"$key\">$val</p></div>",
                $tpl
            );
        };

        return $tpl;
    }

}