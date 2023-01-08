<?php

namespace DatabaseFactory\Modules\MySQL;

use DatabaseFactory\Modules;
use DatabaseFactory\Contracts;

/**
 * SQL GROUP BY
 *
 * @package DatabaseFactory\Modules
 * @author  Jason Napolitano
 *
 * @version 1.0.0
 * @since   1.0.0
 * @license MIT <https://mit-license.org>
 */
class GroupBy extends Modules\MySQL\Builder implements Contracts\SQLStatementInterface
{
    /**
     * @inheritdoc
     */
    public function statement(string $table, ...$params): string
    {
        return static::GROUP_BY . static::columns($params);
    }
}
