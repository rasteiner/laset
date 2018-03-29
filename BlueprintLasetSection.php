<?php

namespace Kirby\Cms;

class BlueprintLasetSection extends BlueprintSection {
    public function errors() {
        return [];
    }
    
    public function toArray(): array
    {
        if($this->modelType() !== 'page') {
            return [
                'error' => 'You can use the laset section only on pages'
            ];
        }

        $date = filemtime($this->model()->root() . DS . $this->model()->template() . '.txt');
        $ago = time() - $date;

        return [
            'date'   => $date,
            'ago' => $ago,
            'name'   => $this->name(),
            'type'   => $this->type()
        ];
    }
}
