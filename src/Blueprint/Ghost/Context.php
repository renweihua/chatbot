<?php

/**
 * This file is part of CommuneChatbot.
 *
 * @link     https://github.com/thirdgerb/chatbot
 * @document https://github.com/thirdgerb/chatbot/blob/master/README.md
 * @contact  <thirdgerb@gmail.com>
 * @license  https://github.com/thirdgerb/chatbot/blob/master/LICENSE
 */

namespace Commune\Blueprint\Ghost;

use ArrayAccess;
use Commune\Blueprint\Ghost\Runtime\Node;
use Commune\Blueprint\Ghost\Exceptions\NotInstanceException;
use Commune\Support\Arr\ArrayAndJsonAble;
use Commune\Blueprint\Ghost\Convo\ConvoInstance;
use Commune\Support\DI\Injectable;

/**
 * 当前语境. 用来读写当前语境的变量.
 *
 * @author thirdgerb <thirdgerb@gmail.com>
 */
interface Context extends ArrayAccess, ArrayAndJsonAble, ConvoInstance, Injectable
{
    const NAMESPACE_SEPARATOR = '.';

    /*----- name -----*/

    public function getName() : string;

    /*----- 数据 -----*/

    /**
     * 合并 Data 到当前数据.
     * @param array $data
     * @throws NotInstanceException
     */
    public function merge(array $data) : void;

    /**
     * 重置当前数据
     * @param array|null $data 为 null 则用默认值
     * @throws NotInstanceException
     */
    public function reset(array $data = null) : void;

    /**
     * @return string
     * @throws NotInstanceException
     */
    public function getId() : string;

    /**
     * @return int
     */
    public function getPriority() : int;

    /**
     * 获取所有的变量值.
     * @return array
     */
    public function toAttributes() : array;

    /**
     * 获取所有 Entity 的值.
     * @return array
     */
    public function toEntities() : array;

    /**
     * 递归地获取所有属性的值.
     * @return array
     */
    public function toArray(): array;

    /*----- 方法 -----*/

    /**
     * 将一个 Context 生成为一个 Node 节点.
     * @return Node
     */
    public function toNewNode() : Node;
}