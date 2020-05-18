<?php

namespace src\helpers;

/**
 * Class HtmlHelpers
 * Class HtmlHelpers is a class that allows you to build html pages to save.
 *
 * Example usage:
 * $example =  HtmlHelpers::html_page_builder($array_pages_tag);
 *
 * @access public
 * @package src/helpers
 * @author Layiri Batiene <eratos02@yahoo.fr>
 */
class HtmlHelpers
{

    /**
     * This function is used to generate HTML5 page in string
     *
     * @param array $array_pages_tag
     * @return string
     */
    public static function html_page_builder($array_pages_tag)
    {
        $css = self::cssStyle();
        $js = self::jsStyle();
        $table = self::table_builder($array_pages_tag);
        return <<<HTML

        <!DOCTYPE html>
<html>
<head>
<style>
$css
</style>
</head>
<body>
$table

<script>$js</script>
</body>
</html>


HTML;

    }

    /**
     * This function is used to generate html tables
     *
     * @param array $array_pages_tag
     * @return string
     */
    public static function table_builder($array_pages_tag)
    {
        $table = '<table class="sort">';
        $table .= '<thead><tr>';
        $table .= '<th>' . implode('</th><th>', array_keys(current($array_pages_tag))) . '</th>';
        $table .= '</tr></thead>';

        $table .= '<tbody>';
        foreach ($array_pages_tag as $key => $value) {
            $table .= '<tr>';
            foreach ($value as $key2 => $value2) {
                $table .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';

        return $table;
    }

    /**
     * This function is used to generate css style sheets
     *
     * @return string
     */
    public static function cssStyle()
    {
        return <<<CSS
.sort table {
    border-collapse: collapse;
}

.sort th {
    color: #ffebcd;
    background: #995c00;
    cursor: pointer;
}

.sort td,
.sort th {
    width: 250px;
    height: 50px;
    text-align: center;
    border: 1px solid #440202;
}

.sort tbody tr:nth-child(even) {
    background: #e3e3e3;
}

th.sorted[data-order="1"],
th.sorted[data-order="-1"] {
    position: relative;
}

th.sorted[data-order="1"]::after,
th.sorted[data-order="-1"]::after {
    right: 8px;
    position: absolute;
}

th.sorted[data-order="-1"]::after {
	content: "▼"
}

th.sorted[data-order="1"]::after {
	content: "▲"
}
CSS;
    }

    /**
     * This function is used to generate javascript scripts
     *
     * @return string
     */
    public static function jsStyle()
    {
        return <<<JS
document.addEventListener('DOMContentLoaded', () => {

    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || -1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );
        
        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
    
    document.querySelectorAll('.sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    
});
JS;

    }

}