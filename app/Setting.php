<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    /**
     * Set value of setting
     *
     * @param array $changes
     */
    public static function set($changes)
    {
        foreach ($changes as $key => $value) {
            DB::table('settings')->where([
                ['key', '=', $key]
            ])->update(['value' => $value]);
        }
    }

    public static function get($key = null)
    {
        foreach ($key as $key) {
            $result[] = $settings[$key];
        }

        return $result;
    }
}
