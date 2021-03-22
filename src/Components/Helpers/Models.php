<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Components\Helpers;

trait Models
{
    /**
     * Set if the model has the trait softdelete
     */
    public function hasSoftdelete(object $model): bool
    {
        return method_exists($model, 'bootSoftDeletes');
    }

    /**
     * Set if the model has softdeleting results
     */
    public function hasSoftdeletedResults(object $model): bool
    {
        return method_exists($model, 'bootSoftDeletes') && $model->trashed();
    }
}
