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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'website_link',
        'designation',
        'primary_country',
        'secondary_countries',
        'linkedin',
        'investment_expertise',
        'is_approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is an investor.
     */
    public function isInvestor()
    {
        return $this->role === 'investor';
    }

    /**
     * Check if the user is a seeker.
     */
    public function isSeeker()
    {
        return $this->role === 'seeker';
    }
    /**
     * Check user account status.
     */
     public function status()
     {
        if ($this->account_status == "free"){
            return 'Free Tier';
        } elseif ($this->account_status == "core"){
            return 'Core Tier';
        } elseif ($this->account_status == "advanced"){
            return 'Advanced Tier';
        } elseif ($this->account_status == "institutional"){
            return 'Institutional Tier';
        } elseif ($this->account_status == "disabled"){
            return 'Disabled';
        }
     }
    /**
     * Check user payment status.
     */
     public function paymentStatus()
     {
        if($this->payment_status=="free"){
            return 'Non-Payable';
        } elseif($this->payment_status=="due"){
            return 'Due';
        } elseif($this->payment_status=="paid"){
            return 'Paid';
        }

     }
}
