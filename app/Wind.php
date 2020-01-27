<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wind extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ 'direction', 'speed' ];

    protected $casts = [
        'direction' => 'int',
        'speed' => 'float',
    ];

    /**
     * Getter for 'direction' attribute.
     *
     * @return int
     */
    public function getDirectionAttribute(): int
    {
        return $this->attributes['direction'];
    }

    /**
     * Setter for 'direction' attribute
     *
     * @param int $direction
     *
     * @return void
     */
    public function setDirectionAttribute(int $direction): void
    {
        $this->attributes['direction'] = $direction;
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
