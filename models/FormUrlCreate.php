<?php

namespace app\models;

use yii;
use yii\base\Model;

class FormUrlCreate extends Model
{
    private $_url;
    public $url;
    public $short;
    public $dieable;


    public function rules()
    {
        return [
            [['url'], 'required', 'message' => 'Введите адрес ссылки'],
            [['url'], 'string', 'max' => 255, 'tooLong' => 'Превышена длина'],
            [['url'], 'url', 'message' => 'Это не адрес ссылки'],
            [['short'], 'string', 'max' => 8, 'tooLong' => 'Ссылка должна быть не более 8 символов', 'min' => 3, 'tooShort' => 'Минимум 3 символа'],
            [['dieable'], 'default', 'value' => 0],
            [['dieable'], 'number', 'max' => 1],
            [['short'], 'unique', 'targetClass' => Url::className()]
        ];
    }

    function attributeLabels()
    {
        return [
            'url' => 'Адрес ссылки',
            'short' => 'Короткая ссылка',
            'dieable' => 'Ограниченный срок жизни'
        ];
    }

    function create()
    {
        if ($this->validate()) {
            $this->_url = new Url();
            $this->_url->origin = $this->url;
            $this->_url->short = $this->short ? $this->short : Yii::$app->security->generateRandomString(8);
            $this->_url->dieable = $this->dieable;

            return $this->_url->save();
        }

        return false;
    }

    function getCreatedUrl()
    {
        return $this->_url;
    }
}