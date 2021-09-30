<?php

namespace App\Models;

class VacancyLevel
{
    public $remainingCount;

    public function __construct(int $remainingCount)
    {
        $this->remainingCount = $remainingCount;
    }

    public function __toString()
    {
        return $this->mark();
    }

    public function slug(): string
    {
        if ($this->remainingCount === 0) {
            return 'empty';
        }
        if ($this->remainingCount < 5) {
            return 'few';
        }
        return 'enough';
    }

    public function mark(): string
    {
        $marks = ['empty' => '×', 'few' => '△', 'enough' => '◎'];
        $slug = $this->slug();
        assert(isset($marks[$slug]), new \DomainException('invalid slug value.'));

        return $marks[$slug];
    }

    // public function mark(): string
    // {
    //     if ($this->remainingCount === 0) {
    //         return '×';
    //     }
    //     if ($this->remainingCount < 5) {
    //         return '△';
    //     }
    //     return '◎';
    // }
}
