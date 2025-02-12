<?php

namespace App\Libraries;

class Template
{
    function display($content = "", $data = [])
    {
        $template['pagecontent'] = view($content, $data);
        echo view('template/index', $template);
    }
}
