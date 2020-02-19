<?php
declare(strict_types=1);

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use app\models\UserDetails;
use app\models\CustomerDetails;

class MoveDataController extends Controller
{
    private const BATCH_SIZE = 20;

    /**
     * This command echoes what you have entered as the message.
     * @return int Exit code
     */
    public function actionIndex()
    {
        $userDetailsActiveQuery = UserDetails::find();
        $customerDetailsDB = CustomerDetails::getDb();

        $count = $userDetailsActiveQuery->count();
        Console::startProgress(0, $count);
        $i = 0;
        $rows = [];
        foreach ($userDetailsActiveQuery->each(self::BATCH_SIZE) as $userDetails) {
            $customerDetails = new CustomerDetails();
            $customerDetails->fullname = $userDetails->name . ' '.$userDetails->surname;
            $customerDetails->e_mail = $userDetails->email;
            $customerDetails->balance = $userDetails->data;
            $customerDetails->totalpurchase = $userDetails->data2;
            $rows[] = $customerDetails->attributes;

            if (($i++ % self::BATCH_SIZE) === 0) {
                $customerDetailsDB->createCommand()->batchInsert(CustomerDetails::tableName(), $customerDetails->attributes(), $rows)->execute();
                $rows = [];
            }
            Console::updateProgress($i, $count);
        }
        if (isset($rows[0])) {
            $customerDetailsDB->createCommand()->batchInsert(CustomerDetails::tableName(), $customerDetails->attributes(), $rows)->execute();
        }
        Console::endProgress();

        return ExitCode::OK;
    }
}
