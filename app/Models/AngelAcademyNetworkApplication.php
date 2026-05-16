<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AngelAcademyNetworkApplication extends Model
{
    public const INVESTED_BEFORE = [
        'no_but_interested' => 'No, but interested',
        'yes_1_2' => 'Yes, 1–2 deals',
        'yes_3_10' => 'Yes, 3–10 deals',
        'active_10_plus' => 'Active angel investor (10+)',
    ];

    public const PRIMARY_MOTIVATION = [
        'learn_angel_investing' => 'Learn angel investing',
        'build_vc_career' => 'Build VC career',
        'access_dealflow' => 'Access dealflow',
        'expand_network' => 'Expand network',
        'start_syndicating' => 'Start syndicating',
        'transition_into_vc' => 'Transition into venture capital',
        'support_founders' => 'Support Founders',
    ];

    public const STARTUP_STAGES = [
        'pre_seed' => 'Pre-seed',
        'seed' => 'Seed',
        'series_a' => 'Series A',
        'growth' => 'Growth',
    ];

    public const SECTORS = [
        'fintech' => 'Fintech',
        'commerce' => 'Commerce',
        'saas' => 'SaaS',
        'climate' => 'Climate',
        'healthcare' => 'Healthcare',
        'ai' => 'AI',
        'logistics' => 'Logistics',
        'agritech' => 'Agritech',
        'consumer' => 'Consumer',
        'deeptech' => 'Deeptech',
        'other' => 'Other',
    ];

    public const CHEQUE_SIZE = [
        'lt_1k' => '<$1K',
        '1k_5k' => '$1K–5K',
        '5k_25k' => '$5K–25K',
        '25k_plus' => '$25K+',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'contact_number',
        'linkedin_url',
        'invested_before',
        'primary_motivation',
        'startup_stages',
        'sectors',
        'sectors_other',
        'cheque_size',
    ];

    protected function casts(): array
    {
        return [
            'startup_stages' => 'array',
            'sectors' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
