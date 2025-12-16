<?php

namespace App\Models\Api;

use App\Models\Api\BaseApiModel;

class Plan extends BaseApiModel
{
    protected $fillable = [
        'id',
        'name',
        'priceMonth',
        'priceYear',
        'commitment',
        'credits',
        'adDurationHours',
        'features',
        'isActive',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'features' => 'array',
        'isActive' => 'boolean',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];

    public function getIsPremiumAttribute(): bool
    {
        return $this->priceYear > 0 && $this->priceMonth == 0;
    }

    public function getFormattedCreatedAt(): string
    {
        return $this->createdAt->format('d/m/Y H:i:s');
    }

    public function getFormattedUpdatedAt(): string
    {
        return $this->updatedAt->format('d/m/Y H:i:s');
    }
}
