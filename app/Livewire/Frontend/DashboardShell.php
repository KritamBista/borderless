<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class DashboardShell extends Component
{
    public bool $sidebarOpen = false;

    public function openSidebar() { $this->sidebarOpen = true; }
    public function closeSidebar() { $this->sidebarOpen = false; }
    public function toggleSidebar() { $this->sidebarOpen = !$this->sidebarOpen; }

    public function render()
    {
        $nav = [
            [
                'label' => 'My Orders',
                'route' => 'user.orders',
                'icon'  => '📦',
            ],
            [
                'label' => 'My Profile',
                'route' => 'user.profile',
                'icon'  => '👤',
            ],
        ];

        return view('livewire.frontend.dashboard-shell',
         [
            'nav' => $nav,
        ]);
    }
}
