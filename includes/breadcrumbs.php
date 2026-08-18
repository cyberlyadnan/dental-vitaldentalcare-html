<?php
// Breadcrumb rendering (visual + JSON-LD).

function breadcrumbs(array $crumbs): string {
    $html  = '<nav class="breadcrumbs" aria-label="Breadcrumb"><ol>';
    $last  = end($crumbs);
    foreach ($crumbs as $c) {
        if ($c === $last) {
            $html .= '<li aria-current="page">' . e($c['name']) . '</li>';
        } else {
            $html .= '<li><a href="' . url($c['url']) . '">' . e($c['name']) . '</a></li><li class="sep" aria-hidden="true">/</li>';
        }
    }
    $html .= '</ol></nav>';
    return $html;
}
