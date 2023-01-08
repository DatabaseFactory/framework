<?php

namespace DatabaseFactory\Contracts {

    /**
     * Contract for the entity objects
     *
     * @package DatabaseFactory\Contracts
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    interface BaseEntityInterface
    {
	    /**
	     * Save a record
	     *
	     * @return bool|int
	     */
	    public function save(): bool|int;
    }
}
