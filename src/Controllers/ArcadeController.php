<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * ArcadeController — Interactive Retro Game Arcade Page
 */
class ArcadeController extends Controller
{
    public function index(): void
    {
        $data = [
            'pageTitle' => "Retro Arcade & Web Games | Balamurugan P M",
            'thisPage'  => "Game",
        ];

        $this->render('views/game', $data);
    }
}
