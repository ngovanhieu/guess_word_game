<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class PlayingPanel extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run($round, $room)
    {
        if ($room->status == config('room.status.playing')) {

            return view($this->getPlayingPanelView($round), [
                'round' => $round,
            ]);
        }

        return '';
    }

    private function getPlayingPanelView($round) {
        if ($round->isDrawer()) {
            $role = 'drawer';
        } else {
            $role = 'guesser';
        }

        if (!$round->word_id) {
            return 'front-end.room.' . $role . '.word';
        } elseif (!$round->image) {
            return 'front-end.room.' . $role . '.image';
        } elseif (!$round->answer) {
            return 'front-end.room.' . $role . '.answer';
        }

        return 'front-end.room.' . $role . '.result';
    }
}
