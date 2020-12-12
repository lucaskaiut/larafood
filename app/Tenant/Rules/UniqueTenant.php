<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table, $columnValue, $column;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $table, $columnValue = null, $column = 'id')
    {
        $this->table = $table;

        $this->columnValue = $columnValue;

        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenantId = app(ManagerTenant::class)->getTenantIdentify();

        $register = DB::table($this->table)
                        ->where($attribute, $value)
                        ->where('tenant_id', $tenantId)
                        ->first();

        if($register && $register->{$this->column} == $this->columnValue)
            return true;

        return is_null($register);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor :attribute já está em uso!';
    }
}
