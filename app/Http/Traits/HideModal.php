<?php

namespace App\Http\Traits;

/**
 *
 */
trait HideModal
{
    /**
     * @param $modalId
     * @return void
     */

    public function showModal($modalId): void
    {
        $this->dispatchBrowserEvent('showModal', ['modalId' => $modalId]);
    }

    public function closeModal($modalId): void
    {
        $this->dispatchBrowserEvent('hideModal', ['modalId' => $modalId]);
    }
}
