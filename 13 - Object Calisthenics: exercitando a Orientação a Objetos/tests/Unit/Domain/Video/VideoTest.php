<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Video;

use Alura\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    //public function testChangeVisibilityMustWork()
    public function testMakingAVideoPublicMustWork()
    {
        $video = new Video();
        //$video->checkIfVisibilityIsValidAndUpdateIt(Video::PUBLIC);
        $video->publish();

        //self::assertSame(Video::PUBLIC, $video->getVisibility());
        self::assertTrue($video->isPublish());
    }
}
