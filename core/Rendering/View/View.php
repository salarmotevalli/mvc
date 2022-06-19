<?php

namespace App\core\Rendering\View;

use App\core\Application;

class View
{

    public function renderView(string $view): array|bool|string
    {
        return str_replace('{{content}}', $this->onlyView($view), $this->layOutContent());
    }

    private function layOutContent(): bool|string
    {
        $layout= Application::$app->controller->layout;
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layout/{$layout}.php";
        return ob_get_clean();
    }

    public function onlyView($view): bool|string
    {
        ob_start();
        require_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

}