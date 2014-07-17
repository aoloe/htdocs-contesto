<?php
/**
 * accepts two level navigations
 */
?>
<div class="menu">
<ul class="menu">
<?php
foreach ($navigation as $item) :
echo(strtr(
    '<li class="%css_li_base%css_li_current%css_li_children"><a href="%href">%label</a>',
    array(
        '%css_li_base' => 'menu-item menu-item-type-custom menu-item-object-custom',
        '%css_li_current' => 'current-menu-item',
        '%css_li_current' => array_key_exists('current', $item) && $item['current'] ? ' current-menu-item' : '',
        '%css_li_children' => array_key_exists('children', $item) ? ' menu-item-has-children' : '',
        '%href' => $item['href'],
        '%label' => $item['label'],
    )
));
if (array_key_exists('children', $item) && is_array($item['children']) && !empty($item['children'])) :
echo("\n".'<ul class="sub-menu">'."\n");
foreach ($item['children'] as $iitem) :
    echo(strtr(
        '<li class="%css_li_base"><a href="%href">%label</a></li>'."\n",
        array(
            '%css_li_base' => 'menu-item menu-item-type-custom menu-item-object-custom',
            '%href' => $iitem['href'],
            '%label' => $iitem['label'],
        )
    ));
endforeach;
echo("</ul>\n");
endif;
echo("</li>\n");
endforeach;
?>
</ul>
</div> <!-- menu -->
