<?php

/*
 * This file is part of Laravel Settings.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Tests\Settings\Facades;

use BrianFaust\Settings\Facades\Setting;
use BrianFaust\Settings\SettingsManager;
use BrianFaust\Tests\Settings\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;

    protected function getFacadeAccessor()
    {
        return 'settings-manager';
    }

    protected function getFacadeClass()
    {
        return Setting::class;
    }

    protected function getFacadeRoot()
    {
        return SettingsManager::class;
    }
}
