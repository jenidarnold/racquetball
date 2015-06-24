<?php

namespace App\Http\Composers;

use App\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

class PlayerComposer
{
    /**
     * The player implementation.
     *
     * @var Player
     */
    protected $players;

    /**
     * Create a new player composer.
     *
     * @param  Player  $players
     * @return void
     */
    public function __construct(Player $players)
    {
        // Dependencies automatically resolved by service container...
        $this->players = $players;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->players->count());
    }
}