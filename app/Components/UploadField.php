<?php

namespace App\Components;

class UploadField extends Component{

    public function get(){
        ob_start(); ?>

            <label><?php echo $this->title; ?></label>
            <div action="<?php echo $this->getUploadURL(); ?>" class="dropzone upload-field">
                <div class="
                fallback">
                    <input name="<?php echo $this->name; ?>" type="file">
                </div>
            </div>
            <script>
                var UploadDir = "<?php echo $this->getUploadDir(); ?>";
                var UploadURL = "<?php echo $this->getUploadURL(); ?>";
                var Name = "<?php echo $this->name; ?>";
                var MaxFileCount = "<?php echo $this->getMaxFiles(); ?>";
                var RemoveURL = "<?php echo $this->getRemoveURL(); ?>";
                var FetchURL = "<?php echo $this->getFetchURL(); ?>";
            </script>
        <?php
        return ob_get_clean();
    }
}
