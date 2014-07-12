<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Evgen
 * Date: 11.07.14
 * Time: 15:53
 * To change this template use File | Settings | File Templates.
 */

class CAPTCHAG {
    /**
     * Проверяет правильность введенной капчи
     * @return bool
     */
   public static  function checkCaptchaAnswer($answ){
        $rightAnsw = isset($_SESSION['captcha'])? $_SESSION['captcha']: '';
        return $answ == $rightAnsw;
    }

    /**
     * Генерация капчи, возвращает ответ и визуальное представление
     * @return mixed array
     */

    public static function generateCapcha(){
// generate numbers and symbol
        $a = rand(1, 10);
        $b = rand(1, 10);
        $z = rand(0, 1);
        if($z == 0){
            $rezult[] = $a.' + '.$b;
            $rezult[] = $a+$b;
        }else{
            $rezult[] = $a.' - '.$b;
            $rezult[] = $a-$b;
        }
        $_SESSION['captcha'] = $rezult[1];
        return $rezult[0];
    }

}