$html .= '</div>';
$html .= '</div>';
$html .= '
<div class="row">';
    if (!isset($department)) {
    $html .= '
    <button class="btn waves-effect waves-light" name="action" value="create" type="submit">
        Hinzufügen';
        $html .= '<i class="material-icons right">+</i>';
        $html .= '
    </button>
    ';
    } else {
    $html .= '
    <button class="btn waves-effect waves-light" name="action" value="update" type="submit">
        Ändern';
        $html .= '<i class="material-icons right">+</i>';
        $html .= '
    </button>
    ';
    }
    $html .= '
</div>';
$html .= '</form>';
$html .= '</div>';