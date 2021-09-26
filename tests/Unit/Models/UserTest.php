<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use Mockery;
use Mockery\MockInterface;


class UserTest extends TestCase
{

/**
 * @param string $plan
 * @param int $remainingCount
 * @param int $reservationCount
 * @dataProvider dataCanReserve_正常
 */
    // public function testCanReserve(string $plan, int $remainingCount, int $reservationCount, bool $canReserve)
    public function testCanReserve_正常(string $plan, int $remainingCount, int $reservationCount)
    {
        /** @var User $user */
        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
        $user->plan = $plan;

        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

        $user->canReserve($lesson);
        // 例外が出ないことを確認するアサーションがないので代わりに
        $this->assertTrue(true);
    }

    public function dataCanReserve()
    {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
                'plan'                  => 'regular',
                'capacity'              => 2,
                'totalReservationCount' => 1,
                'userReservationCount'  => 4,
                'canReserve'            => true,
            ]
        ];
    }

    /**
     * @param string $plan
     * @param int $remainingCount
     * @param int $reservationCount
     * @param string $errorMessage
     * @dataProvider dataCanReserve_エラー
     */
    public function testCanReserve_エラー(string $plan, int $remainingCount, int $reservationCount, string $errorMessage)
    {
        /** @var User $user */
        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
        $user->plan = $plan;


        
        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

        $this->expectExceptionMessage($errorMessage);

        $this->assertSame($canReserve, $user->canReserve($lesson, $reservationCount));
    }

    public function dataCanReserve_エラー()
    {
        return [
            '予約不可:レギュラー,空きあり,月の上限' => [
                'plan' => 'regular',
                'remainingCount' => 1,
                'reservationCount' => 5,
                'errorMessage' => '今月の予約がプランの上限に達しています。',
            ],
            '予約不可:レギュラー,空きなし,月の上限以下' => [
                'plan' => 'regular',
                'remainingCount' => 0,
                'reservationCount' => 4,
                'errorMessage' => 'レッスンの予約可能上限に達しています。',
            ],
            '予約不可:ゴールド,空きなし' => [
                'plan' => 'gold',
                'remainingCount' => 0,
                'reservationCount' => 5,
                'errorMessage' => 'レッスンの予約可能上限に達しています。',
            ],
        ];
    }
}
