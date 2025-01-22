<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Investment;
use App\Models\Subscription;
use App\Models\Commit;


class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use InteractsWithMedia, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'primary_country',
        'primary_contact',
        'secondary_contact',
        'preference_sector',
        'designation',
        'organization',
        'registered_by',
        'phone',
        'email',
        'joined_at',
        'renewed',
        'last_renewed_at',
        'account_owner',
        'total_invested',
        'company_name',
        'revenue_generated',
        'notes',
        'status',
        'is_overseas',
        'was_referred',
        'referred_by',
        'country',
        'role',
        'is_approved',
        'website_link',
        'secondary_countries',
        'password',
        'investment_expertise',
        'account_status',
        'payment_status',
        'linkedin',
        'expertise_level',
        'address',
        'used_by',
        'level',
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

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
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
    public function isFree()
    {
        return $this->account_status === 'free';
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

    public function getProfilePhotoUrl(): string
    {
        $media = $this->getFirstMedia('profile_photo');

        // Return the URL if media exists, otherwise return a default placeholder
        return $media ? $media->getUrl() : asset('default_pfp.jpg');
    }

    public function joinedAt(): string
    {
        // Get the year of creation
        $year = $this->created_at->format('Y');

        // Get the month of creation
        $month = $this->created_at->format('n');

        // Determine the quarter
        $quarter = ceil($month / 3); // 1-3 = Q1, 4-6 = Q2, 7-9 = Q3, 10-12 = Q4

        // Return the formatted string
        return "{$year} Q{$quarter}";
    }

    public function renewedAt(): string
    {
        // Ensure the "updated_at" field exists
        if (!$this->updated_at) {
            return "Not renewed";
        }

        // Get the year of the last update
        $year = $this->updated_at->format('Y');

        // Get the month of the last update
        $month = $this->updated_at->format('n');

        // Determine the quarter
        $quarter = ceil($month / 3); // 1-3 = Q1, 4-6 = Q2, 7-9 = Q3, 10-12 = Q4

        // Return the formatted string
        return "{$year} Q{$quarter}";
    }

    public function commits()
    {
        return $this->hasMany(Commit::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class, 'user_id');
    }
}
