<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComplaint extends Notification
{
    use Queueable;
    protected $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "شكوى جديدة من {$this->complaint->name}: {$this->complaint->subject}",
            'icon' => 'fa-solid fa-flag',
            'icon_color' => '#f59e0b',
            'link' => route('admin.complaints.show', $this->complaint->id),
            'complaint_id' => $this->complaint->id,
        ];
    }
}
