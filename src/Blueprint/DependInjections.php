<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Blueprint;

use Commune\Blueprint\Ghost\Cloner;
use Commune\Blueprint\Ghost\Mindset;
use Commune\Contracts;
use Commune\Protocals;
use Commune\Blueprint\Framework;
use Commune\Blueprint\Configs;
use Commune\Support\Registry\OptRegistry;
use Commune\Support\SoundLike\SoundLikeInterface;
use Psr\Log\LoggerInterface;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 */
interface DependInjections
{

    const BASIC_APP_BINDINGS = [
        Framework\ServiceRegistry::class,
        Contracts\Log\ConsoleLogger::class,
        Contracts\Log\LogInfo::class,
    ];

    const APP_PROC_BINDINGS = [
        Contracts\Log\ExceptionReporter::class,
        Contracts\Trans\Translator::class,
        OptRegistry::class,
        LoggerInterface::class,
        SoundLikeInterface::class,
    ];

    /*------- host -------*/

    const HOST_PROC_BINDINGS = [
        Host::class,
        Configs\HostConfig::class,
    ];

    /*------- ghost -------*/

    // ghost 的进程级绑定
    const GHOST_PROC_BINDINGS = [
        Ghost::class,
        Configs\GhostConfig::class,
        Mindset::class,
    ];

    // ghost 的请求级绑定.
    const GHOST_REQ_BINDINGS = [
        Contracts\Cache::class,
        Ghost\Cloner\ClonerScene::class,
        Ghost\Cloner\ClonerScope::class,
        Ghost\Cloner\ClonerLogger::class,
        Ghost\Cloner\ClonerStorage::class,
        Ghost\Runtime\Runtime::class,
        Contracts\Ghost\RuntimeDriver::class,
        Ghost\Auth\Authority::class,
    ];

    // ghost 请求创建时绑定的实例.
    const GHOST_REQ_INSTANCES = [
        Cloner::class,
        Framework\ReqContainer::class,
        Protocals\Intercom\InputMsg::class,
        Protocals\Comprehension::class,
    ];

    /*------- shell -------*/

    const SHELL_PROC_BINDINGS = [
        Shell::class,
        Configs\ShellConfig::class,
    ];

    const SHELL_REQ_BINDINGS = [
        Shell::class,
        Contracts\Cache::class,
        Shell\Session\ShellLogger::class,
        Shell\Session\ShellStorage::class,
    ];

    const SHELL_REQ_INSTANCES = [
        Shell\ShellSession::class,
        Framework\ReqContainer::class,
        Protocals\Intercom\InputMsg::class,
        Protocals\Comprehension::class,
    ];
}