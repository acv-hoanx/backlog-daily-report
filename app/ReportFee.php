<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportFee extends Model
{
    protected $fillable = [
        'thunhapthang', 'nguoiphuthuoc', 'thunhaptinhthue', 'thueTNCN', 'remoteAddress', 'userAgent'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'report_fee';
}
