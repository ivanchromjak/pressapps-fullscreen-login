<?php

/**
 * Copyright (c) 2015, Aleksey Korzun <aleksey@webfoundation.net>
 * All rights reserved.
 *
*/

class PAFL_Response
{
    /**
     * Is response valid
     *
     * @var bool
     */
    protected $isValid;

    /**
     * Currently set error message
     *
     * @var string
     */
    protected $error;

    /**
     * Set flag for a valid response indicator
     *
     * @param bool $flag
     * @return Response
     */
    public function setValid($flag)
    {
        $this->isValid = (bool) $flag;
        return $this;
    }

    /**
     * Checks if response is valid (good)
     *
     * @return bool
     */
    public function isValid()
    {
        return (bool) $this->isValid;
    }

    /**
     * Set error message that should be returned to user
     *
     * @param string $error
     * @return Response
     */
    public function setError($error)
    {
        $this->error = (string) $error;
        return $this;
    }

    /**
     * Retrieve currently set error message
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}

