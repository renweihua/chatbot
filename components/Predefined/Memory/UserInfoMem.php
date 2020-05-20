<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Components\Predefined\Memory;

use Commune\Blueprint\Ghost\Cloner\ClonerScope;
use Commune\Blueprint\Ghost\Dialog;
use Commune\Blueprint\Ghost\MindDef\StageDef;
use Commune\Host\Contexts\AMemoryContext;
use Commune\Blueprint\Ghost\Context\ParamBuilder;
use Commune\Blueprint\Ghost\Context\StageBuilder as Stage;

/**
 * @author thirdgerb <thirdgerb@gmail.com>
 *
 * @property-read string $name
 * @property-read int $loginTimes
 */
class UserInfoMem extends AMemoryContext
{
    public static function __scopes(): array
    {
        return [ClonerScope::GUEST_ID];
    }

    public static function __params(ParamBuilder $param) : ParamBuilder
    {
        return $param
            ->add('name')
            ->add('loginTimes', 0);
    }

    public function increaseLoginTimes() : void
    {
        $this->loginTimes = $this->loginTimes + 1;
    }

    public static function __entities(): array
    {
        return ['name'];
    }


    public function __on_name(Stage $stage) : StageDef
    {
        return $stage
            ->onActivate(function(Dialog $dialog){
                return $dialog
                    ->nav()
                    ->await()
                    ->askAny('请问我应该如何称呼您');
            })
            ->onEvent(
                Dialog::HEED,
                function(Dialog $dialog)
                {

                    return $dialog
                        ->hearing()
                        ->isAnyAnswer()
                        ->then(function(Dialog $dialog, string $answer){
                            if (mb_strlen($answer) > 10) {
                                $dialog
                                    ->send()
                                    ->notice("称呼请麻烦控制在10个字符之内");

                                return $dialog->nav()->rewind();
                            }

                            return $dialog->nav()->next();
                        })
                        ->end();

                }
            )
            ->end();
    }


}