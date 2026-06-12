<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site.name', 'value' => 'Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur', 'group_name' => 'site'],
            ['key' => 'site.short_name', 'value' => 'BPAD NTT', 'group_name' => 'site'],
            ['key' => 'site.tagline', 'value' => 'Melayani dengan transparan dan akuntabel', 'group_name' => 'site'],
            ['key' => 'site.copyright_year', 'value' => (string) now()->year, 'group_name' => 'site'],
            ['key' => 'hero.title', 'value' => 'Optimalisasi Pendapatan Daerah & Pengelolaan Aset', 'group_name' => 'hero'],
            ['key' => 'hero.description', 'value' => 'Memberikan pelayanan prima dalam pengelolaan pendapatan daerah dan aset untuk mendukung pembangunan Nusa Tenggara Timur yang berkeadilan dan berkelanjutan.', 'group_name' => 'hero'],
            ['key' => 'hero.badge.image', 'value' => '/assets/ayobangunntt.png', 'group_name' => 'hero'],
            ['key' => 'hero.badge.alt', 'value' => 'Ayo Bangun NTT', 'group_name' => 'hero'],
            ['key' => 'hero.slide.2', 'value' => '/assets/herox.jpeg', 'group_name' => 'hero'],
            ['key' => 'hero.slide.4', 'value' => '/assets/heroy.jpeg', 'group_name' => 'hero'],
            ['key' => 'pad.realisasi.value', 'value' => null, 'group_name' => 'pad'],
            ['key' => 'pad.target_text', 'value' => '2800000000000', 'group_name' => 'pad'],
            ['key' => 'pad.percentage', 'value' => null, 'group_name' => 'pad'],
            ['key' => 'pad.updated_at', 'value' => 'Update 10 Juni 2026', 'group_name' => 'pad'],
            ['key' => 'pad.status', 'value' => 'Menunggu data resmi', 'group_name' => 'pad'],
            ['key' => 'contact.email', 'value' => 'bapenda@nttprov.go.id', 'group_name' => 'contact'],
            ['key' => 'contact.phone', 'value' => '-', 'group_name' => 'contact'],
            ['key' => 'contact.address', 'value' => 'Jl. El Tari No.52, Oebobo, Kota Kupang', 'group_name' => 'contact'],
            ['key' => 'contact.hours.weekday', 'value' => '07.30 - 15.30 WITA', 'group_name' => 'contact'],
            ['key' => 'contact.hours.friday', 'value' => '07.30 - 11.30 WITA', 'group_name' => 'contact'],
            ['key' => 'form.ppid_request.url', 'value' => 'https://forms.gle/sLJVuwdGrZnQTJ3N7', 'group_name' => 'ppid'],
            ['key' => 'form.ppid_objection.url', 'value' => 'https://forms.gle/Us5L3Peh8N1L99iq7', 'group_name' => 'ppid'],
        ];

        foreach ($settings as $setting) {
            $existing = WebsiteSetting::where('key', $setting['key'])->first();
            // Preserve existing PAD numeric values (don't overwrite real data with null)
            if ($existing && in_array($setting['key'], ['pad.realisasi.value', 'pad.percentage']) && $setting['value'] === null) {
                continue;
            }
            WebsiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                [...$setting, 'is_public' => true],
            );
        }
    }
}
