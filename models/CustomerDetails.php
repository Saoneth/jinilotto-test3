<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class CustomerDetails extends ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('db_destination');
    }

}