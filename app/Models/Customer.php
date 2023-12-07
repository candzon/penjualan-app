<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $tables = 'customers';
    protected $guarded = [];

    public function getCustomers()
    {
        $customers = DB::table('customers')->get();
        return $customers;
    }
}
