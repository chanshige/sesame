<?php

declare(strict_types=1);

namespace Chanshige\SmartLock\Sesame\Action;

/** @see https://doc.candyhouse.co/ja/SesameAPI#web-api-%E3%81%AB%E3%82%88%E3%82%8B%E6%96%BD%E8%A7%A3%E9%8C%A0 */
enum Cmd: int
{
    case TOGGLE = 88;
    case LOCK = 82;
    case UNLOCK = 83;
}
