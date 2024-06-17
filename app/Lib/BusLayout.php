<?php

namespace App\Lib;

class BusLayout
{
    protected $trip;
    protected $fleet;
    public $sitLayouts;
    protected $totalRow;
    protected $deckNumber;
    protected $seatNumber;

    public function __construct($trip)
    {
        $this->trip = $trip;
        $this->fleet = $trip->fleetType;
        $this->sitLayouts = $this->sitLayouts();
    }

    public function sitLayouts()
    {
        // Remove any extra spaces and then explode the seat_layout string
        $seatLayout = explode('x', str_replace(' ', '', $this->fleet->seat_layout));

        // Initialize the layout array
        $layout = ['left' => 0, 'right' => 0];
        if (count($seatLayout) >= 2) {
            $layout['left'] = $seatLayout[0];
            $layout['right'] = $seatLayout[1];
        } else {
            \Log::error('Invalid seat layout format: ' . $this->fleet->seat_layout);
        }

        // Return the layout as an object
        return (object)$layout;
    }



    public function getDeckHeader($deckNumber)
    {
        $html = '
            <span class="front">Front</span>
            <span class="rear">Rear</span>
        ';
        if ($deckNumber == 0) {
            $html .= '
                <span class="lower">Door</span>
                <span class="driver"><img src="' . getImage('assets/templates/basic/images/icon/wheel.svg') . '" alt="icon"></span>
            ';
        } else {
            $html .= '<span class="driver">Deck :  ' . ($deckNumber + 1) . '</span>';
        }
        return $html;
    }

    public function getSeats($deckNumber, $seatNumber)
    {
        $this->deckNumber = $deckNumber;
        $this->seatNumber = $seatNumber;
        $seats = [
            'left' => $this->leftSeats(),
            'right' => $this->rightSeats(),
        ];
        return (object)$seats;
    }

    protected function leftSeats()
    {
        $html = '<div class="left-side">';
        $seatData = '';
        for ($i = 1; $i <= $this->sitLayouts->left; $i++) {
            $seatData .= $this->generateSeats($i);
        }

        $html .= $seatData;
        $html .=  '</div>';
        return $html;
    }

    protected function rightSeats()
    {
        $html = '<div class="right-side">';

        $seatData = '';
        for ($i = 1; $i <= $this->sitLayouts->right; $i++) {
            $seatData .= $this->generateSeats($i + $this->sitLayouts->left);
        }

        $html .= $seatData;
        $html .=  '</div>';
        return $html;
    }

    public function generateSeats($loopIndex, $deckNumber = null, $seatNumber = null)
    {
        $deckNumber = $deckNumber ?? $this->deckNumber;
        $seatNumber = $seatNumber ?? $this->seatNumber;
        return "<div>
                    <span class='seat' data-seat='" . ($deckNumber . '-' . $seatNumber . '' . $loopIndex) . "'>
                        $this->seatNumber$loopIndex
                        <span></span>
                    </span>
                </div>";
    }

    public function getTotalRow($seat)
    {
        $sitLayouts = $this->sitLayouts();

        $rowItem = $sitLayouts->left + $sitLayouts->right;

        // Check if rowItem is zero to prevent division by zero
        if ($rowItem == 0) {
            // Handle the error: return a default value, log an error, or throw an exception
            \Log::error('Invalid seat layout resulting in division by zero.');
            return 0; // Returning 0 as a default value, you can change this as needed
        }

        $totalRow = floor($seat / $rowItem);
        $this->totalRow = $totalRow;

        return $this->totalRow;
    }


    public function getLastRowSit($seat)
    {
        $rowItem = $this->sitLayouts->left + $this->sitLayouts->right;
        $lastRowSeat = $seat - $this->getTotalRow($seat) * $rowItem;
        return $lastRowSeat;
    }
}
