<?php
namespace Morilog\EloquentSti\Models;

interface SingleTableInheritable
{   
    /**
     * @return string
     */
    public function getStiClassField();

    /**
     * Get Single Table Inheritable 
     * base model full class name
     * 
     * @return string
     */
    public function getStiBaseClass();

    /**
     * @return string
     */
    public static function getRelationForeignKey();
}