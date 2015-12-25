<?php namespace Morilog\EloquentSti\Models;

use Illuminate\Database\Eloquent\Model;

abstract class SingleTableInheritableModel extends Model implements SingleTableInheritable
{

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);


        if ((new \ReflectionClass(get_class($this)))->isInstantiable()) {
            $this->setAttribute($this->getStiClassField(), get_class($this));
        }

    }

    public function newQuery($excludeDeleted = true)
    {
        $builder = parent::newQuery($excludeDeleted);


        if (get_class($this) !== $this->getStiBaseClass()) {
            $builder->orWhere($this->getStiClassField(), '=', get_class($this));
        }


        return $builder;
    }

    public function newFromBuilder($attributes = array(), $connection = null)
    {
        if ($this->getAttribute($this->getStiClassField())) {

            $class = $this->getAttribute($this->getStiClassField());
            $instance = new $class;

            $instance->exists = true;
            $instance->setRawAttributes((array)$attributes, true);


            return $instance;
        } else {
            return parent::newFromBuilder($attributes, $connection);
        }
    }
}