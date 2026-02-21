<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->string('facebook_url')->nullable()->after('logo');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('instagram_url');
            $table->string('youtube_url')->nullable()->after('linkedin_url');

            $table->string('contact_email')->nullable()->after('youtube_url');
            $table->string('contact_phone')->nullable()->after('contact_email');
            $table->string('whatsapp_number')->nullable()->after('contact_phone');
            $table->string('address')->nullable()->after('whatsapp_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //

            $table->dropColumn([
                'facebook_url',
                'instagram_url',
                'linkedin_url',
                'youtube_url',
                'contact_email',
                'contact_phone',
                'whatsapp_number',
                'address'
            ]);
        });
    }
};
