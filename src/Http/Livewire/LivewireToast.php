<?php

namespace Ascsoftw\LivewireToast\Http\Livewire;

use Livewire\Component;

class LivewireToast extends Component
{
    protected $listeners = ['show', 'showWarning', 'showError', 'showInfo', 'showSuccess'];
    public $message;
    public $type;
    public $positionCss;
    public $bgColorCss;
    public $textColorCss;
    public $duration;
    public $showIcon;
    public $hideOnClick;
    public $transition;
    public $transitioClasses;

    protected $transitions = [
        'rotate' => ['rotate-180', 'rotate'],
        'zoom_in' => ['scale-50', 'scale-100'],
        'appear_from_right' => ['translate-x-1/2', 'translate-x-0'],
        'appear_from_left' => ['-translate-x-1/2', 'translate-x-0'],
        'appear_from_below' => ['translate-y-1/2', 'translate-y-0'],
        'appear_from_above' => ['-translate-y-1/2', 'translate-y-0'],
    ];

    public function mount()
    {
        $this->_setType();
        $this->_setDuration();
        $this->_setBackgroundColor();
        $this->_setTextColor();
        $this->_setPosition();
        $this->_setIcon();
        $this->_setClickHandler();
        $this->_setTransition();

        if($message = session('livewire-toast')) {
            $this->show($message);
        }
    }

    public function show($params)
    {
        $this->_setDuration();
        $type = '';
        if (is_array($params)) {
            $this->message = $params['message'] ?? '';
            $type = $params['type'] ?? '';
            $this->duration = $params['duration'] ?? $this->duration;
        } else {
            $this->message = $params;
        }
        $this->_setType($type);

        $this->_setBackgroundColor();
        $this->_setTextColor();
        $this->_setIcon();

        if (!empty($this->message)) {
            $this->dispatch('new-toast');
        }
    }

    public function showWarning(string $message, int $duration = null)
    {
        $this->show([
            'type' => 'warning',
            ...get_defined_vars(),
        ]);
    }

    public function showInfo(string $message, int $duration = null)
    {
        $this->show([
            'type' => 'info',
            ...get_defined_vars(),
        ]);
    }

    public function showError(string $message, int $duration = null)
    {
        $this->show([
            'type' => 'error',
            ...get_defined_vars(),
        ]);
    }

    public function showSuccess(string $message, int $duration = null)
    {
        $this->show([
            'type' => 'success',
            ...get_defined_vars(),
        ]);
    }

    public function render()
    {
        return view('livewire-toast::livewire.livewire-toast');
    }

    private function _setType($type = '')
    {
        if (in_array($type, ['warning', 'info', 'error', 'success'])) {
            $this->type = $type;
        } else {
            $this->type = config('livewire-toast.type');
        }
    }

    private function _setBackgroundColor()
    {
        $this->bgColorCss = config('livewire-toast.color.bg.' . $this->type);
    }

    private function _setTextColor()
    {
        $this->textColorCss = config('livewire-toast.text_color');
    }

    private function _setPosition()
    {
        switch (config('livewire-toast.position')) {
            case 'top-left':
                $this->positionCss = 'top-4 left-4';
                break;
            case 'top-right':
                $this->positionCss = 'top-4 right-4';
                break;
            case 'bottom-left':
                $this->positionCss = 'bottom-4 left-4';
                break;
            case 'bottom-right':
            default:
                $this->positionCss = 'bottom-4 right-4';
        }
    }

    private function _setDuration()
    {
        $this->duration = (int)config('livewire-toast.duration');
    }

    private function _setIcon()
    {
        $this->showIcon = (boolean)config('livewire-toast.show_icon');
    }

    private function _setClickHandler()
    {
        $this->hideOnClick = (boolean)config('livewire-toast.hide_on_click');
    }

    private function _setTransition()
    {
        $this->transition = (boolean)config('livewire-toast.transition');
        if ($this->transition) {
            $this->transitioClasses['leave_end_class'] =
            $this->transitioClasses['enter_start_class'] =
            reset($this->transitions[config('livewire-toast.transition_type')]);

            $this->transitioClasses['leave_start_class'] =
            $this->transitioClasses['enter_end_class'] =
            end($this->transitions[config('livewire-toast.transition_type')]);
        }
    }
}
