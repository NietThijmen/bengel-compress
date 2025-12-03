<?php

namespace Bengelmedia\BengelCompress\Svelte;

class AjaxHelper
{
    public static function generateAjaxScript(): void
    {
        // always enqueue an inline script with window.bengelCompress = { ajaxUrl: ... }
        $inline_script = sprintf(
            "
                <script type='text/javascript'>
                    window.bengelCompress = {
                        ajaxUrl: '%s',
                        nonce: '%s'
                    };
                </script>
            ",
            admin_url('admin-ajax.php'),
            wp_create_nonce('bengel_compress_nonce')
        );


        echo $inline_script;
    }

}
