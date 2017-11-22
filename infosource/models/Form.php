<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Form extends Model
{
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                ['reCaptcha'],
                \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),
                'secret' => '6Lde7iIUAAAAAK9ulujKzwJ2bSZzrdfkqyAF_yWv',
                'uncheckedMessage' => 'Please confirm that you are not a bot.'
            ]
        ];
    }
}
?>