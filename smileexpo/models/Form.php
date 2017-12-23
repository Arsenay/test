<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Form extends Model
{
    public $items;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['items'], 'required'],
            ['items', 'number'],
        ];
    }
}
?>