<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'sectorista_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con el sectorista (si el usuario es un sectorista)
     */
    public function sectorista()
    {
        return $this->belongsTo(Sectorista::class, 'sectorista_id');
    }

    /**
     * Verificar si es Secretario CTPPGE
     */
    public function isSecretarioCTPPGE(): bool
    {
        return $this->role === 'secretario_ctppge';
    }

    /**
     * Verificar si es Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Verificar si es Procurador PGE
     */
    public function isProcuradorPGE(): bool
    {
        return $this->role === 'procurador_pge';
    }

    /**
     * Verificar si es Responsable de Componente
     */
    public function isResponsableComponente(): bool
    {
        return $this->role === 'responsable_componente';
    }

    /**
     * Verificar si es Órgano Colegiado
     */
    public function isOrganoColegiado(): bool
    {
        return $this->role === 'organo_colegiado';
    }

    /**
     * Verificar si es Sectorista
     */
    public function isSectorista(): bool
    {
        return $this->role === 'sectorista';
    }

    /**
     * Obtener el nombre del rol para mostrar
     */
    public function getRoleNameAttribute(): string
    {
        $roles = [
            'admin' => 'Administrador',
            'secretario_ctppge' => 'Secretario CTPPGE',
            'procurador_pge' => 'Procurador(a) PGE',
            'responsable_componente' => 'Responsable de Componente',
            'organo_colegiado' => 'Órgano Colegiado',
            'sectorista' => 'Sectorista',
        ];

        return $roles[$this->role] ?? 'Usuario';
    }

    /**
     * Verificar si puede editar Actividad 1 (planes de implementación)
     */
    public function canEditActivity1(): bool
    {
        return in_array($this->role, ['admin', 'secretario_ctppge']);
    }

    /**
     * Verificar si puede ver todos los módulos
     */
    public function canViewAllModules(): bool
    {
        return in_array($this->role, ['admin', 'procurador_pge']);
    }

    /**
     * Verificar si puede gestionar Actividad 2
     */
    public function canManageActivity2(): bool
    {
        return in_array($this->role, ['admin', 'sectorista']);
    }
}
