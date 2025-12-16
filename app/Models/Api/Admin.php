<?php

namespace App\Models\Api;

use App\Models\User;
use App\Models\Api\BaseApiModel;

class Admin extends BaseApiModel
{
    protected $fillable = [
        'userId',
        'role',
        'permissions',
        'status'
    ];

    protected $casts = [
        'permissions' => 'array',
        'status' => 'boolean'
    ];

    public const PERMISSIONS_LABELS = [
        'manageJobs'          => "Offres d'emplois",
        'manageSubscriptions' => 'Abonnements',
        'managePayments'      => 'Paiements',
        'manageAdmins'        => 'Admins',
        'manageLogs'          => 'Historique',
        'managePremium'       => 'Premium',
        'manageTags'          => 'Tags',
        'manageUsers'         => 'Utilisateurs',
        'manageSettings'      => 'Paramètres',
    ];

    public const ROLES = [
        'super-admin' => 'Super admin',
        'admin'       => 'Admin',
        'moderator'   => 'Modérateur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
