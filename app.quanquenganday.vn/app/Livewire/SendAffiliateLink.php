<?php

namespace App\Livewire;

use Livewire\Component;

class SendAffiliateLink extends Component
{
   public $link;
    public $type;

    public function sendLink()
    {
        // Giả lập logic gửi (Bạn có thể thêm gửi Mail/Zalo ở đây)
        sleep(1); 
        $this->dispatch('alert', message: 'Hệ thống đang chuẩn bị gửi link mời ' . $this->type);
    }

    public function render()
    {
        return view('livewire.send-affiliate-link');
    }
}
