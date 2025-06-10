<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $location
 * @property string $description
 * @property string|null $photo
 * @property int $report_status_id
 * @property string|null $admin_notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ReportStatus $status
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereReportStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUserId($value)
 * @mixin \Eloquent
 */
class Report extends Model
{
    use HasFactory;

    // Atribut yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'location',
        'description',
        'photo',
        'report_status_id',
        'admin_notes',
    ];

    /**
     * Mendefinisikan hubungan banyak-ke-satu (many-to-one) dengan model User.
     * Satu Laporan dimiliki oleh satu User (Pelapor).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan hubungan banyak-ke-satu (many-to-one) dengan model ReportStatus.
     * Satu Laporan memiliki satu Status Laporan.
     */
    public function status()
    {
        return $this->belongsTo(ReportStatus::class, 'report_status_id');
    }
}