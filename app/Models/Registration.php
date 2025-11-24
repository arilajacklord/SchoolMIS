<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Enrollment;

class Registration extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // Table name
    protected $table = 'registration';

    // Primary key
    protected $primaryKey = 'id';

    // Enable timestamps since your migration uses them
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * Relationship to the User model.
     * `user_id` references `users.id`
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship to enrollments.
     * A registration can have multiple enrollments.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'user_id');
    }

    /**
     * Optional: Relationship to grades through enrollments
     */
    public function grades()
    {
        return $this->hasManyThrough(
            Grade::class,
            Enrollment::class,
            'user_id',      // Foreign key on enrollments table
            'enroll_id',    // Foreign key on grades table
            'user_id',      // Local key on registration table
            'enroll_id'     // Local key on enrollment table
        );
    }
}
