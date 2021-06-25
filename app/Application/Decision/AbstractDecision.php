<?php


namespace App\Application\Decision;


use App\Domain\Decision\MissionDecision;

abstract class AbstractDecision implements MissionDecision
{
    public const HTML_OUTPUT = 1;
    public const CLI_OUTPUT  = 2;
}
