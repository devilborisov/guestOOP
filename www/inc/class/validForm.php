<?php

class validForm  {
    /**
     * Валидация формы проверяет введенные параметры, выводит true или false, и array ошибок если не прошла проверка
     * @param array $form
     * @return bool
     */
    /**
     * Проверяет правильность введенной капчи
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
            $errors['userName'] = "Имя пользователя должно содержать не менее 3 символов и состоять из двух слов";
        }
        if(!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/',$formData['userEmail'])){
            $validation = false;
            $errors['userEmail'] = "Неправильно введен email. Должен быть вида example@gmail.com";
        }
        if(strlen($formData['userMsg'])<15){
            $validation = false;
            $errors['userMsg'] = "Сообщение пользователя должно содержать не менее 15 символов";
        }else{
            $_SESSION['userMsg'] = $formData['userMsg'];
        }
        if(self::checkCaptchaAnswer($formData['inputCapcha'])!=true){
            $validation = false;
            $errors['inputCapcha'] = "Неправильный ответ";
        }
        if(!$validation){
            return $errors;
        }else{
            return $validation;
        }


    }
    /**
     * Проверяет была ли отправлена форма
     * @return bool
     */
    public static function isFormSubmitted(){
        return (isset($_POST) AND !empty($_POST));
    }
    /**
     * Выводит сообщения об ошибках в переданный шаблон
     * @param $tpl - входной html
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