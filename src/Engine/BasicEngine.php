<?php

namespace LilouView\Engine;

class BasicEngine {

    public function if($content = "") {
        return "<?php if($content): ?>";
    }

    public function endif() {
        return "<?php endif; ?>";
    }

    public function else() {
        return "<?php else: ?>";
    }

    public function elseif($content = "") {
        return "<?php elseif($content): ?>";
    }

    public function foreach($content = "") {
        return "<?php foreach($content): ?>";
    }

    public function endforeach() {
        return "<?php endforeach; ?>";
    }

    public function for($content = "") {
        return "<?php for($content): ?>";
    }

    public function endfor() {
        return "<?php endfor; ?>";
    }

    public function while($content = "") {
        return "<?php while($content): ?>";
    }

    public function endwhile() {
        return "<?php endwhile; ?>";
    }

    public function include($content = "") {
        return "<?php include($content); ?>";
    }

}
