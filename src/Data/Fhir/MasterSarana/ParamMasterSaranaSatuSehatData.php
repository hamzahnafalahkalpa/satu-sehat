<?php

namespace Hanafalah\SatuSehat\Data\Fhir\MasterSarana;

use Hanafalah\SatuSehat\Data\ParamSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MasterSarana\ParamMasterSaranaSatuSehatData as DataParamMasterSaranaSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\In;

class ParamMasterSaranaSatuSehatData extends ParamSatuSehatData implements DataParamMasterSaranaSatuSehatData
{
    #[MapInputName('limit')]
    #[MapName('limit')]
    public ?string $limit = null;

    #[MapInputName('page')]
    #[MapName('page')]
    public ?string $page = null;

    #[MapInputName('lower_bound_updated_at')]
    #[MapName('lower_bound_updated_at')]
    #[DateFormat('Y-m-d')]
    public ?string $lower_bound_updated_at = null;

    #[MapInputName('upper_bound_updated_at')]
    #[MapName('upper_bound_updated_at')]
    #[DateFormat('Y-m-d')]
    public ?string $upper_bound_updated_at = null;

    #[MapInputName('kode_satusehat')]
    #[MapName('kode_satusehat')]
    public ?string $kode_satusehat = null;

    #[MapInputName('kode_sarana')]
    #[MapName('kode_sarana')]
    public ?string $kode_sarana = null;

    #[MapInputName('jenis_sarana')]
    #[MapName('jenis_sarana')]
    #[In(104,103,102,101)]
    // Rumah sakit (104)
    // Klinik (103)
    // PUSKESMAS (102)
    // Praktek mandiri (101)
    public ?string $jenis_sarana = null;

    #[MapInputName('nama')]
    #[MapName('nama')]
    public ?string $nama = null;

    #[MapInputName('kode_provinsi')]
    #[MapName('kode_provinsi')]
    public ?string $kode_provinsi = null;

    #[MapInputName('kode_kabkota')]
    #[MapName('kode_kabkota')]
    public ?string $kode_kabkota = null;

    #[MapInputName('kode_kecamatan')]
    #[MapName('kode_kecamatan')]
    public ?string $kode_kecamatan = null;

    #[MapInputName('status_aktif')]
    #[MapName('status_aktif')]
    #[In('draft', 'verified', 'valid', 'reverified')]
    public ?string $status_aktif = null;

    #[MapInputName('status_sarana')]
    #[MapName('status_sarana')]
    public ?string $status_sarana = null;

    #[MapInputName('sumber_identifier')]
    #[MapName('sumber_identifier')]
    #[In(
        'satset', 'dto_msfi', 'yankes_praktik_mandiri', 
        'yankes_klinik', 'yankes_rs', 'puskesmas_pusdatin_baru',
        'puskesmas_pusdatin_lama','sisdmk_sarana',
        'yankes_praktik_mandiri_kmk','yankes_klinik_kmk',
        'yankes_utd','yankes_utd_kmk','yankes_labkes',
        'yankes_labkes_kmk'
    )]
    // satset = Satu Sehat
    // dto_msfi = DTO - MSFI
    // yankes_praktik_mandiri = Yankes - Praktik Mandiri
    // yankes_klinik = Yankes - Klinik
    // yankes_rs = Yankes - RS
    // puskesmas_pusdatin_baru = Puskesmas Pusdatin (Baru)
    // puskesmas_pusdatin_lama = Puskesmas Pusdatin (Lama)
    // sisdmk_sarana = SISDMK Sarana
    // yankes_praktik_mandiri_kmk = Yankes - Praktik Mandiri (KMK 2022)
    // yankes_klinik_kmk = Yankes - Klinik (KMK 2022)
    // yankes_utd = Yankes - UTD
    // yankes_utd_kmk = Yankes - UTD (KMK 2022)
    // yankes_labkes = Yankes - Labkes
    // yankes_labkes_kmk = Yankes - Labkes (KMK 2022)
    public ?string $sumber_identifier = null;

    #[MapInputName('identifier_kode_sarana')]
    #[MapName('identifier_kode_sarana')]
    public ?string $identifier_kode_sarana = null;

    public static function before(array &$attributes){
        $new = static::new();
        $serialize = [
            'limit' => $attributes['limit'] ?? null,
            'page' => $attributes['page'] ?? null,
            'lower_bound_updated_at' => $attributes['lower_bound_updated_at'] ?? null,
            'upper_bound_updated_at' => $attributes['upper_bound_updated_at'] ?? null,
            'kode_satusehat' => $attributes['kode_satusehat'] ?? null,
            'kode_sarana' => $attributes['kode_sarana'] ?? null,
            'jenis_sarana' => $attributes['jenis_sarana'] ?? null,
            'nama' => $attributes['nama'] ?? null,
            'kode_provinsi' => $attributes['kode_provinsi'] ?? null,
            'kode_kabkota' => $attributes['kode_kabkota'] ?? null,
            'kode_kecamatan' => $attributes['kode_kecamatan'] ?? null,
            'status_aktif' => $attributes['status_aktif'] ?? null,
            'status_sarana' => $attributes['status_sarana'] ?? null,
            'sumber_identifier' => $attributes['sumber_identifier'] ?? null,
            'identifier_kode_sarana' => $attributes['identifier_kode_sarana'] ?? null,
        ];
        $attributes['query'] = $new->serialize($serialize);
    }
}