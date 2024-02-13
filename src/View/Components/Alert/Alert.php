<?php
namespace Permittedleader\Laraforms\View\Components\Alert;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Level of this alert
     *
     * @var string [danger,warning,info,success]
     */
    public $level;

    /**
     * Is this dismissable?
     *
     * @var bool
     */
    public $dismissable;

    public $classes;

    public $icon;

    public $buttonStyle;

    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($level = 'warning', $dismissable = false, $size = 'md')
    {
        $this->level = $level;
        if ($this->level == 'success') {
            $this->classes = 'border-success-500 bg-success-200 text-black';
            $this->icon = 'fas fa-check fa-2x fa-fw text-success-500';
            $this->buttonStyle = 'bg-success-700 text-success-200';
        } elseif ($this->level == 'info') {
            $this->classes = 'border-info-500 bg-info-200 text-black';
            $this->icon = 'fas fa-info fa-2x fa-fw text-info-500';
            $this->buttonStyle = 'bg-info-700 text-info-200';
        } elseif ($this->level == 'warning') {
            $this->classes = 'border-warning-500 bg-warning-200 text-black';
            $this->icon = 'fas fa-exclamation fa-2x fa-fw text-warning-500';
            $this->buttonStyle = 'bg-warning-700 text-warning-200';
        } elseif ($this->level == 'danger') {
            $this->classes = 'border-danger-500 bg-danger-200 text-black';
            $this->icon = 'fas fa-times fa-2x fa-fw text-danger-500';
            $this->buttonStyle = 'bg-danger-700 text-danger-200';
        }
        $this->dismissable = $dismissable;
        $this->size = $size;
        if ($this->size == 'sm') {
            $this->classes .= ' text-xs my-1 px-2 py-2 border-l-4';
        } elseif ($this->size == 'md') {
            $this->classes .= ' my-3 px-3 py-2 border-l-8';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('laraforms::components.alert.alert');
    }
}
