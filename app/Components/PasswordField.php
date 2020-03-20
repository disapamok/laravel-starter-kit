<?php

namespace App\Components;

class PasswordField extends Component{

    public function get(){
        ob_start(); ?>

            <div class="form-group <?php echo $this->groupClasses; ?>">
                <label><?php echo $this->title; ?></label>
                <input name="<?php echo $this->name; ?>" value="<?php echo old($this->name) ?>" type="password" placeholder="<?php echo $this->placeholder; ?>" class="form-control <?php echo $this->classes; ?>">
            </div>

        <?php
        return ob_get_clean();
    }
}
