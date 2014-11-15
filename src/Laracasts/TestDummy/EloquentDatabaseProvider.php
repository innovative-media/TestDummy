<?php namespace Laracasts\TestDummy;


use Illuminate\Database\Eloquent\Model as Eloquent;

class EloquentDatabaseProvider implements BuildableRepositoryInterface {

    /**
     * Build the entity with attributes.
     *
     * @param string $type
     * @param array $attributes
     * @throws TestDummyException
     * @return Eloquent
     */
    public function build($type, array $attributes)
    {
        // We can disable mass assignment protection.
        Eloquent::unguard();

        if ( ! class_exists($type))
        {
            throw new TestDummyException("The {$type} model was not found.");
        }

        $object = new $type($attributes);

        // Re-enable mass assignment protection
        Eloquent::reguard();

        return $object;
    }

    /**
     * Persist the entity.
     *
     * @param Model $entity
     * @return void
     */
    public function save($entity)
    {
        // We can disable mass assignment protection.
        Eloquent::unguard();

        $entity->save();

        // Re-enable mass assignment protection
        Eloquent::reguard();
    }

}
