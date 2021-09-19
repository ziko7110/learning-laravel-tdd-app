<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Models\Lesson;

class UserTest extends TestCase
{
/**
 * @param string $plan
 * @param int $remainingCount
 * @param int $reservationCount
 * @param bool $canReserve
 * @dataProvider dataCanReserve
 */
    public function testCanReserve(string $plan, int $remainingCount, int $reservationCount, bool $canReserve)
    {
        $user       = new User();
        $user->plan = $plan;
        $lesson     = new Lesson();
        $this->assertSame($canReserve, $user->canReserve($lesson->remainingCount(), $reservationCount));
    }

    public function dataCanReserve()
    {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
                'plan'             => 'regular',
                'remainingCount'   => 1,
                'reservationCount' => 4,
                'canReserve'       => true,
            ],
            '予約不可:レギュラー,空きあり,月の上限' => [
                'plan'             => 'regular',
                'remainingCount'   => 1,
                'reservationCount' => 5,
                'canReserve'       => false,
            ],
        ];
    }
}
