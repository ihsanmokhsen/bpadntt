<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteSettingRequest;
use App\Models\AuditLog;
use App\Models\WebsiteSetting;
use Database\Seeders\WebsiteSettingSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
    public function edit(): View
    {
        $settings = WebsiteSetting::query()
            ->orderBy('key')
            ->get()
            ->keyBy('key');

        $definitions = $this->definitions();
        $values = $this->currentValues($settings);

        return view('admin.settings.edit', [
            'sections' => $definitions,
            'values' => $values,
            'count' => $settings->count(),
        ]);
    }

    public function update(WebsiteSettingRequest $request): RedirectResponse
    {
        $oldValues = WebsiteSetting::query()
            ->whereIn('key', array_column($this->fieldDefinitions(), 'setting_key'))
            ->pluck('value', 'key')
            ->all();

        $newValues = $this->persistSettings($request);

        AuditLog::create([
            'user_id' => $request->user()->id,
            'action' => 'website_settings.updated',
            'subject_type' => WebsiteSetting::class,
            'subject_id' => null,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Pengaturan website berhasil disimpan.');
    }

    public function resetDefaults(): RedirectResponse
    {
        DB::transaction(function () {
            (new WebsiteSettingSeeder())->run();
        });

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'website_settings.reset_defaults',
            'subject_type' => WebsiteSetting::class,
            'subject_id' => null,
            'old_values' => null,
            'new_values' => null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Semua pengaturan telah diisi ulang ke nilai default.');
    }

    private function persistSettings(WebsiteSettingRequest $request): array
    {
        $values = $request->validated();
        $saved = [];

        DB::transaction(function () use ($values, &$saved): void {
            foreach ($this->fieldDefinitions() as $field) {
                $value = $values[$field['name']] ?? null;

                WebsiteSetting::updateOrCreate(
                    ['key' => $field['setting_key']],
                    [
                        'value' => $value === null || $value === '' ? null : (string) $value,
                        'group_name' => $field['group_name'],
                        'is_public' => $field['is_public'],
                    ]
                );

                $saved[$field['setting_key']] = $value === null || $value === '' ? null : (string) $value;
            }
        });

        return $saved;
    }

    private function definitions(): array
    {
        return [
            [
                'title' => 'Identitas Website',
                'description' => 'Nama instansi, nama singkat, dan slogan yang dipakai di halaman publik.',
                'fields' => array_slice($this->fieldDefinitions(), 0, 4),
            ],
            [
                'title' => 'Hero / Banner',
                'description' => 'Judul, deskripsi, badge, dan gambar slider untuk banner halaman depan.',
                'fields' => array_slice($this->fieldDefinitions(), 4, 8),
            ],
            [
                'title' => 'Data PAD',
                'description' => 'Nilai dan status PAD yang tampil sebelum hero pada halaman publik.',
                'fields' => array_slice($this->fieldDefinitions(), 12, 5),
            ],
            [
                'title' => 'Kontak Resmi',
                'description' => 'Email, nomor telepon, alamat kantor, dan jam layanan publik.',
                'fields' => array_slice($this->fieldDefinitions(), 17, 5),
            ],
            [
                'title' => 'Media Sosial',
                'description' => 'Tautan sosial media resmi yang bisa ditampilkan pada halaman publik.',
                'fields' => array_slice($this->fieldDefinitions(), 17, 4),
            ],
            [
                'title' => 'Form PPID',
                'description' => 'Tautan Google Form untuk permohonan informasi dan keberatan PPID.',
                'fields' => array_slice($this->fieldDefinitions(), 21, 2),
            ],
        ];
    }

    private function currentValues($settings): array
    {
        $values = [];

        foreach ($this->fieldDefinitions() as $field) {
            $values[$field['name']] = $settings->get($field['setting_key'])?->value;
        }

        return $values;
    }

    private function fieldDefinitions(): array
    {
        return [
            [
                'name' => 'site_name',
                'setting_key' => 'site.name',
                'group_name' => 'site',
                'label' => 'Nama Website',
                'type' => 'text',
                'placeholder' => 'Badan Pendapatan dan Aset Daerah Provinsi Nusa Tenggara Timur',
                'help' => 'Dipakai sebagai nama utama pada halaman publik dan judul browser.',
                'is_public' => true,
            ],
            [
                'name' => 'site_short_name',
                'setting_key' => 'site.short_name',
                'group_name' => 'site',
                'label' => 'Nama Singkat',
                'type' => 'text',
                'placeholder' => 'BPAD NTT',
                'help' => 'Versi pendek untuk logo, header, dan label antarmuka.',
                'is_public' => true,
            ],
            [
                'name' => 'site_tagline',
                'setting_key' => 'site.tagline',
                'group_name' => 'site',
                'label' => 'Tagline',
                'type' => 'text',
                'placeholder' => 'Melayani dengan transparan dan akuntabel',
                'help' => 'Kalimat singkat yang muncul di hero halaman utama.',
                'is_public' => true,
            ],
            [
                'name' => 'copyright_year',
                'setting_key' => 'site.copyright_year',
                'group_name' => 'site',
                'label' => 'Tahun Copyright',
                'type' => 'number',
                'placeholder' => (string) now()->year,
                'help' => 'Biasanya disesuaikan dengan tahun berjalan.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_title',
                'setting_key' => 'hero.title',
                'group_name' => 'hero',
                'label' => 'Judul Hero',
                'type' => 'text',
                'placeholder' => 'Optimalisasi Pendapatan Daerah & Pengelolaan Aset',
                'help' => 'Judul utama yang tampil pada banner halaman beranda.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_description',
                'setting_key' => 'hero.description',
                'group_name' => 'hero',
                'label' => 'Deskripsi Hero',
                'type' => 'text',
                'placeholder' => 'Memberikan pelayanan prima dalam pengelolaan pendapatan daerah...',
                'help' => 'Paragraf singkat yang muncul di bawah judul hero.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_badge_image',
                'setting_key' => 'hero.badge.image',
                'group_name' => 'hero',
                'label' => 'Badge Hero',
                'type' => 'text',
                'placeholder' => '/assets/ayobangunntt.png',
                'help' => 'URL gambar badge atau logo yang tampil di hero.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_badge_alt',
                'setting_key' => 'hero.badge.alt',
                'group_name' => 'hero',
                'label' => 'Alt Badge Hero',
                'type' => 'text',
                'placeholder' => 'Ayo Bangun NTT',
                'help' => 'Teks alternatif untuk gambar badge hero.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_slide_2',
                'setting_key' => 'hero.slide.2',
                'group_name' => 'hero',
                'label' => 'Hero Slide 2',
                'type' => 'text',
                'placeholder' => '/assets/herox.jpeg',
                'help' => 'Gambar kedua pada slider hero.',
                'is_public' => true,
            ],
            [
                'name' => 'hero_slide_4',
                'setting_key' => 'hero.slide.4',
                'group_name' => 'hero',
                'label' => 'Hero Slide 4',
                'type' => 'text',
                'placeholder' => '/assets/heroy.jpeg',
                'help' => 'Gambar keempat pada slider hero.',
                'is_public' => true,
            ],
            [
                'name' => 'pad_realisasi_value',
                'setting_key' => 'pad.realisasi.value',
                'group_name' => 'pad',
                'label' => 'Realisasi PAD',
                'type' => 'text',
                'placeholder' => 'Rp --',
                'help' => 'Nilai realisasi PAD yang tampil di bar status.',
                'is_public' => true,
            ],
            [
                'name' => 'pad_target_text',
                'setting_key' => 'pad.target_text',
                'group_name' => 'pad',
                'label' => 'Target 2026',
                'type' => 'text',
                'placeholder' => 'Rp 2,8T',
                'help' => 'Target PAD 2026 yang tampil di bar status.',
                'is_public' => true,
            ],
            [
                'name' => 'pad_percentage',
                'setting_key' => 'pad.percentage',
                'group_name' => 'pad',
                'label' => 'Persentase Realisasi',
                'type' => 'text',
                'placeholder' => '--%',
                'help' => 'Persentase pencapaian PAD yang tampil di bar status.',
                'is_public' => true,
            ],
            [
                'name' => 'pad_updated_at',
                'setting_key' => 'pad.updated_at',
                'group_name' => 'pad',
                'label' => 'Tanggal Update',
                'type' => 'text',
                'placeholder' => 'Update 10 Juni 2026',
                'help' => 'Teks tanggal update yang tampil di bar status.',
                'is_public' => true,
            ],
            [
                'name' => 'pad_status',
                'setting_key' => 'pad.status',
                'group_name' => 'pad',
                'label' => 'Status PAD',
                'type' => 'text',
                'placeholder' => 'Menunggu data resmi',
                'help' => 'Status singkat yang tampil di bar status.',
                'is_public' => true,
            ],
            [
                'name' => 'contact_email',
                'setting_key' => 'contact.email',
                'group_name' => 'contact',
                'label' => 'Email Resmi',
                'type' => 'email',
                'placeholder' => 'bapenda@nttprov.go.id',
                'help' => 'Digunakan untuk alamat kontak pada halaman publik.',
                'is_public' => true,
            ],
            [
                'name' => 'contact_phone',
                'setting_key' => 'contact.phone',
                'group_name' => 'contact',
                'label' => 'Nomor Telepon',
                'type' => 'text',
                'placeholder' => '+62 ...',
                'help' => 'Nomor telepon/WA yang bisa dihubungi pengunjung.',
                'is_public' => true,
            ],
            [
                'name' => 'contact_address',
                'setting_key' => 'contact.address',
                'group_name' => 'contact',
                'label' => 'Alamat Kantor',
                'type' => 'text',
                'placeholder' => 'Jl. El Tari No.52, Oebobo, Kota Kupang',
                'help' => 'Alamat singkat yang tampil di header/footer halaman publik.',
                'is_public' => true,
            ],
            [
                'name' => 'contact_hours_weekday',
                'setting_key' => 'contact.hours.weekday',
                'group_name' => 'contact',
                'label' => 'Jam Senin-Kamis',
                'type' => 'text',
                'placeholder' => '07.30 - 15.30 WITA',
                'help' => 'Jam layanan untuk hari kerja awal minggu.',
                'is_public' => true,
            ],
            [
                'name' => 'contact_hours_friday',
                'setting_key' => 'contact.hours.friday',
                'group_name' => 'contact',
                'label' => 'Jam Jumat',
                'type' => 'text',
                'placeholder' => '07.30 - 11.30 WITA',
                'help' => 'Jam layanan untuk hari Jumat.',
                'is_public' => true,
            ],
            [
                'name' => 'instagram_url',
                'setting_key' => 'social.instagram.url',
                'group_name' => 'social',
                'label' => 'Instagram',
                'type' => 'url',
                'placeholder' => 'https://www.instagram.com/bpad_ntt/',
                'help' => 'Tautan akun Instagram resmi.',
                'is_public' => true,
            ],
            [
                'name' => 'facebook_url',
                'setting_key' => 'social.facebook.url',
                'group_name' => 'social',
                'label' => 'Facebook',
                'type' => 'url',
                'placeholder' => 'https://facebook.com/...',
                'help' => 'Tautan halaman Facebook resmi.',
                'is_public' => true,
            ],
            [
                'name' => 'youtube_url',
                'setting_key' => 'social.youtube.url',
                'group_name' => 'social',
                'label' => 'YouTube',
                'type' => 'url',
                'placeholder' => 'https://youtube.com/@...',
                'help' => 'Tautan channel YouTube resmi.',
                'is_public' => true,
            ],
            [
                'name' => 'x_url',
                'setting_key' => 'social.x.url',
                'group_name' => 'social',
                'label' => 'X / Twitter',
                'type' => 'url',
                'placeholder' => 'https://x.com/...',
                'help' => 'Tautan akun X atau Twitter resmi.',
                'is_public' => true,
            ],
            [
                'name' => 'ppid_request_url',
                'setting_key' => 'form.ppid_request.url',
                'group_name' => 'form',
                'label' => 'PPID Permohonan',
                'type' => 'url',
                'placeholder' => 'https://forms.gle/...',
                'help' => 'Ganti saat formulir permohonan informasi sudah siap.',
                'is_public' => true,
            ],
            [
                'name' => 'ppid_objection_url',
                'setting_key' => 'form.ppid_objection.url',
                'group_name' => 'form',
                'label' => 'PPID Keberatan',
                'type' => 'url',
                'placeholder' => 'https://forms.gle/...',
                'help' => 'Ganti saat formulir keberatan PPID sudah dibuat.',
                'is_public' => true,
            ],
        ];
    }
}
