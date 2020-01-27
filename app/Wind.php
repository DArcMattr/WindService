<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wind extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ 'deg', 'speed' ];

    protected $casts = [
        'deg' => 'int',
        'speed' => 'float',
    ];

    /**
     * Getter for 'deg' attribute.
     *
     * @return int
     */
    public function getDegAttribute(): int
    {
        return $this->attributes['deg'];
    }

    /**
     * Setter for 'deg' attribute
     *
     * @param int $deg
     *
     * @return void
     */
    public function setDegAttribute(int $deg): void
    {
        $this->attributes['deg'] = $deg;
    }

    /**
     * Getter for 'speed' attribute
     *
     * @return float
     */
    public function getSpeedAttribute(): float
    {
        return $this->attributes['speed'];
    }

    /**
     * Setter for 'speed' attribute
     *
     * @param float $speed
     *
     * @return void
     */
    public function setSpeedAttribute(float $speed): void
    {
        $this->attributes['speed'] = $speed;
    }
}
