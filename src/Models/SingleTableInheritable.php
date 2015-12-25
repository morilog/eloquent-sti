<?php
namespace Morilog\EloquentSti\Models;

interface SingleTableInheritable
{
    public function getStiClassField();

    public function getStiBaseClass();

}