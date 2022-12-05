<?php

namespace App\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use App\Helpers\CommonHelper;

class CommonHelperTest extends TestCase
{
    public function testUri()
    {
        $commonHelper = new CommonHelper();
        $name = $commonHelper->getControllerPath('sample');
        $this->assertStringContainsString('SampleController', $name);
    }
}