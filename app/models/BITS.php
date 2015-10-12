<?php

namespace BITS;

/**
 * BITS CRUD Services.
 *
 * Class to simply use CRUD Data Management support PDO and PHP OOP.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class BITS extends Query
{
    /**
     * Get method on different class and files.
     * Initialize class and use method with "BITS::getMethod(NameClass, nameMethod, arg1, arg2, arg3)".
     *
     * @param string $classname  Name of class to call of method.
     * @param string $methodname Name of method to call.
     * @param string $arg1       Argument to passed to method.
     * @param string $arg2       etc.
     * @param string $arg3       etc.
     * @param string $arg4       etc.
     * @param string $arg5       etc.
     *
     * @return object Return call object of this method.
     */
    public function getMethod($classname, $methodname, $arg1 = '', $arg2 = '', $arg3 = '', $arg4 = '', $arg5 = '')
    {
        $class = 'BITS\\'.$classname;
        $method = $methodname;

        return $class::$method($arg1, $arg2, $arg3, $arg4, $arg5);
    }
}
