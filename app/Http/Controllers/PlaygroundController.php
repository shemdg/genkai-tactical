<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaygroundController extends Controller
{
    public function index()
    {
        define('gold', 150);
        $item = 'strength';
        switch ($item) {
            case "agility":
                echo "You bought slippers of agility";
                break;
            case "intelligence":
                echo "You bought mantle of intelligence";
                break;
            case "strength":
                echo "You bought gauntlet of strength";
                break;
            default:
                echo "you didnt buy anything";
        }
    }
}
