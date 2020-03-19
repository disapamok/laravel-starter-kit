<?php

namespace App\Components;

class HiddenField extends Component{
    public function get(){
        ob_start(); ?>
            <input type="hidden" name="<?php echo $this->name; ?>" value="<?php echo $this->value; ?>">
        <?php
        return ob_get_clean();
    }
}
