<?php

use App\Models\TeamMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('section', 32);
            $table->string('name');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('linkedin_url', 512)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $this->seedInitialMembers();
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }

    private function seedInitialMembers(): void
    {
        $definitions = [
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Ivy Huq Russell',
                'title' => 'CEO',
                'subtitle' => null,
                'linkedin_url' => 'https://www.linkedin.com/in/ivy-huq-russell-417487/',
                'sort_order' => 1,
                'photo' => 'our team/ivy.png',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Zaaim Zakir',
                'title' => 'Lead Deals Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 2,
                'photo' => 'our team/Zaaim.JPG',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Rifat Ara Bonnhy',
                'title' => 'Strategic Partnerships Lead',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 3,
                'photo' => 'our team/Rifat Ara Bonnhy.JPG',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Nadim Abrar',
                'title' => 'Operations Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 4,
                'photo' => 'our team/Nadim Abrar Hossain.jpg',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Sadman Ishrak Arian',
                'title' => 'Seasonal Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 5,
                'photo' => 'our team/Arian.JPG',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Prajna Paromita',
                'title' => 'Seasonal Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 6,
                'photo' => 'our team/Prajna.JPG',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Arham Ahmed',
                'title' => 'Seasonal Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 7,
                'photo' => 'our team/Arham.jpg',
            ],
            [
                'section' => TeamMember::SECTION_MANAGEMENT,
                'name' => 'Shazid Hossain',
                'title' => 'Seasonal Analyst',
                'subtitle' => null,
                'linkedin_url' => null,
                'sort_order' => 8,
                'photo' => 'our team/Shazid.jpg',
            ],
            [
                'section' => TeamMember::SECTION_GOVERNING_BOARD,
                'name' => 'Sajid Rahman',
                'title' => 'Chief Executive',
                'subtitle' => 'Telenor Health AS',
                'linkedin_url' => 'https://www.linkedin.com/in/rahmansajid/',
                'sort_order' => 1,
                'photo' => 'our team/sajid.png',
            ],
            [
                'section' => TeamMember::SECTION_GOVERNING_BOARD,
                'name' => 'Samad Miraly',
                'title' => 'Co Founder',
                'subtitle' => 'Startup Dhaka',
                'linkedin_url' => 'https://www.linkedin.com/in/miraly/',
                'sort_order' => 2,
                'photo' => 'our team/samad.png',
            ],
            [
                'section' => TeamMember::SECTION_GOVERNING_BOARD,
                'name' => 'Minhaz Anwar',
                'title' => 'Chief Storyteller',
                'subtitle' => 'Better Stories',
                'linkedin_url' => 'https://www.linkedin.com/in/minhazanwar/',
                'sort_order' => 3,
                'photo' => 'our team/minhaz.png',
            ],
            [
                'section' => TeamMember::SECTION_GOVERNING_BOARD,
                'name' => 'Tina Jabeen',
                'title' => 'Investment Advisor',
                'subtitle' => 'Startup Bangladesh',
                'linkedin_url' => 'https://www.linkedin.com/in/tinajabeen/',
                'sort_order' => 4,
                'photo' => 'our team/tina.png',
            ],
            [
                'section' => TeamMember::SECTION_GOVERNING_BOARD,
                'name' => 'Sanchayan Chakraborty',
                'title' => 'Partner',
                'subtitle' => 'Aavishkaar Capital',
                'linkedin_url' => 'https://www.linkedin.com/in/sanchayan-chakraborty-5353105/',
                'sort_order' => 5,
                'photo' => 'our team/sanchayan.png',
            ],
        ];

        foreach ($definitions as $row) {
            $photoRelative = $row['photo'];
            unset($row['photo']);
            $member = TeamMember::query()->create($row);
            $absolute = public_path($photoRelative);
            if (is_file($absolute)) {
                $member->addMedia($absolute)
                    ->preservingOriginal()
                    ->toMediaCollection(TeamMember::MEDIA_PHOTO);
            }
        }
    }
};
