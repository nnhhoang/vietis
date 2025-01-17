<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MonthlyRent;
use App\Models\ApartmentRoom;
use Illuminate\Support\Facades\Mail;
use App\Events\ActionLogged;

class NotifyUnpaidRent extends Command
{
    protected $signature = 'rent:notify-unpaid';
    protected $description = 'Gửi email thông báo phòng chưa thanh toán đủ tiền';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $lastMonth = now()->subMonth();
        $unpaidRents = MonthlyRent::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->whereColumn('paid_amount', '<', 'total_amount')
            ->with('room')
            ->get();

        foreach ($unpaidRents as $rent) {
            $room = $rent->room;
            $email = $room->email ?? 'default@example.com'; // Email người thuê (nếu có)

            // Gửi email
            Mail::raw(
                "Phòng {$room->room_number} chưa thanh toán đủ tiền trong tháng {$lastMonth->format('m/Y')}.",
                function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Thông báo chưa thanh toán đủ tiền trọ');
                }
            );

            event(new ActionLogged(auth()->id() ?? 1, 'Thống kê và gửi thông báo cho các phòng chưa thanh toán tiền trọ.'));

            $this->info("Đã gửi email cho phòng {$room->room_number}.");
        }

        return 0;
    }
}
