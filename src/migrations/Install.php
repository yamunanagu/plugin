<?php

namespace craft\commerce\postfinance\migrations;

use Craft;
use craft\commerce\postfinance\gateways\Gateway;
use craft\db\Migration;
use craft\db\Query;

/**
 * Installation Migration
 *
 */
class Install extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Convert any built-in postfinance gateways to ours
        $this->_convertGateways();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        return true;
    }

    /**
     * Converts any old school postfinance gateways to this one
     *
     * @return void
     */
    private function _convertGateways(): void
    {
        $gateways = (new Query())
            ->select(['id'])
            ->where(['type' => 'craft\\commerce\\postfinance\\gateways\\Gateway'])
            ->from(['{{%commerce_gateways}}'])
            ->all();

        $dbConnection = Craft::$app->getDb();

        foreach ($gateways as $gateway) {
            $values = [
                'type' => Gateway::class,
            ];

            $dbConnection->createCommand()
                ->update('{{%commerce_gateways}}', $values, ['id' => $gateway['id']])
                ->execute();
        }
    }
}
