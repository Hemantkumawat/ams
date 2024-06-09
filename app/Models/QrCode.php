<?php

namespace App\Models;

use App\Enums\QrCodeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'student_id',
        'staff_id',
    ];

    protected $casts = [
        'student_id' => 'integer',
        'staff_id' => 'integer',
        'type' => QrCodeType::class,
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
