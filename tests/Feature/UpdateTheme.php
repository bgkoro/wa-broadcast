<?php

namespace Tests\Feature;

use App\Models\Theme;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateTheme extends TestCase
{
    public function testTheme()
    {
        $jsonS = <<<EOF
{
    '50': '#f9ffe4',
    '100': '#f1ffc6',
    '200': '#e1ff93',
    '300': '#caff54',
    '400': '#b2fa21',
    '500': '#98e802',
    '600': '#71b400',
    '700': '#558803',
    '800': '#456b09',
    '900': '#3b5a0d',
    '950': '#1c3300',
}
EOF;
        $pattern = '/,\s*}$/';
        $correctedString = preg_replace($pattern, '}', $jsonS);
        $jsonString = Str::replace("'", '"', $correctedString);
        $jsonString = json_decode($jsonString, true);
        $theme = Theme::find(1);
        $theme->primary = $jsonString;
        $theme->save();
        $this->assertIsArray($theme->primary);
    }
}
