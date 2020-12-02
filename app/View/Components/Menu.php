<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active;

    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu', ['active' => $this->active]);
    }

    public function lists() {
        return [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fas fa-chalkboard'
            ],
            [
                'label' => 'Movies',
                'route' => 'movies',
                'icon' => 'fas fa-film'
            ],
            [
                'label' => 'Theaters',
                'route' => 'theaters',
                'icon' => 'fas fa-university'
            ],
            [
                'label' => 'Tickets',
                'route' => 'tickets',
                'icon' => 'fas fa-ticket-alt'
            ],
            [
                'label' => 'Users',
                'route' => 'users',
                'icon' => 'fas fa-users'
            ]
        ];
    }

    public function isActive($label) {
        return $label === $this->active;
    }
}
