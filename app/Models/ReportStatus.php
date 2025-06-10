<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Report> $reports
 * @property-read int|null $reports_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReportStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReportStatus extends Model
{
    use HasFactory;

    // Atribut yang bisa diisi secara massal
    protected $fillable = ['name'];

    /**
     * Mendefinisikan hubungan satu-ke-banyak (one-to-many) dengan model Report.
     * Satu Status Laporan bisa dimiliki oleh banyak Laporan.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}