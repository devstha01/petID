<?php

namespace App\Cloudsa9\Entities\Models;

/**
 * Trait ModelTrait
 * @package App\Cloudsa9\Entities\Models
 */
trait ModelTrait
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootModelTrait()
    {
        static::creating(
            function ($model) {
                if (currentUser()) {
                    activity()->causedBy(currentUser() ? currentUser()->id : 1)->performedOn($model)->withProperties($model->toArray())->log(class_basename(get_class($model)) . '_created');
                }
                $model->setAttribute('created_by', currentUser() ? currentUser()->id : 1);
            }
        );
        static::updating(
            function ($model) {
                if (currentUser()) {
                    $model->updated_by = currentUser()->id;
                    activity()->causedBy(currentUser())->performedOn($model)->log(class_basename(get_class($model)) . '_updated');
                }
                $model->setAttribute('updated_by', currentUser() ? currentUser()->id : null);
            }
        );
        static::deleting(
            function ($model) {
                $model->deleted_by = currentUser()->id;
                activity()->causedBy(currentUser())->performedOn($model)->log(class_basename(get_class($model)) . '_deleted');
                $model->setAttribute('deleted_by', currentUser()->id)->save();
            }
        );
    }
}
