<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'primary',
        'secondary',
        'danger',
        'warning',
        'success',
    ];


    /**
     * Get the primary attribute and decode it.
     *
     * @param string $value
     * @return array
     */
    public function getPrimaryAttribute(string $value): array
    {
        return json_decode($value, true);
    }

    /**
     * Set the primary attribute and encode it as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setPrimaryAttribute(array $value): void
    {
        $this->attributes['primary'] = json_encode($value);
    }


    /**
     * Get the secondary attribute and decode it.
     *
     * @param string $value
     * @return array
     */
    public function getSecondaryAttribute(string $value): array
    {
        return json_decode($value, true);
    }

    /**
     * Set the primary attribute and encode it as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setSecondaryAttribute(array $value): void
    {
        $this->attributes['secondary'] = json_encode($value);
    }

    /**
     * Get the danger attribute and decode it.
     *
     * @param string $value
     * @return array
     */
    public function getDangerAttribute(string $value): array
    {
        return json_decode($value, true);
    }

    /**
     * Set the primary attribute and encode it as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setDangerAttribute(array $value): void
    {
        $this->attributes['danger'] = json_encode($value);
    }

    /**
     * Get the warning attribute and decode it.
     *
     * @param string $value
     * @return array
     */
    public function getWarningAttribute(string $value): array
    {
        return json_decode($value, true);
    }

    /**
     * Set the primary attribute and encode it as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setWarningAttribute(array $value): void
    {
        $this->attributes['warning'] = json_encode($value);
    }

    /**
     * Get the success attribute and decode it.
     *
     * @param string $value
     * @return array
     */
    public function getSuccessAttribute(string $value): array
    {
        return json_decode($value, true);
    }

    /**
     * Set the primary attribute and encode it as JSON.
     *
     * @param array $value
     * @return void
     */
    public function setSuccessAttribute(array $value): void
    {
        $this->attributes['success'] = json_encode($value);
    }
}
