<?php

namespace Csr\Cli;

class Utils
{
    public static function normalizePath(string $path): string
    {
        $end = stripos($path, DIRECTORY_SEPARATOR, strlen($path) - 1);

        if ($end === false) {
            $path .= DIRECTORY_SEPARATOR;
        }

        return $path;
    }

    public static function createComponent(string $path, string $name, string $stubPath): int
    {
        $fileName = $path . $name . ".php";
        $status = 0;

        if (!file_exists($fileName)) {
            if (!file_exists($path)) {
                $status = intval(!mkdir($path, 0777, true));
            }
            $status = intval(!touch($fileName));
        }

        $content = file_get_contents($stubPath);
        $content = str_replace('{{name}}', $name, $content);

        if (file_put_contents($fileName, $content) === false) {
            $status = 1;
        }

        return $status;
    }
}
