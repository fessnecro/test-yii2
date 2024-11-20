<?php

namespace app\commands\jobs;

use app\models\Link;
use app\models\Visit;
use yii\base\BaseObject;
use yii\db\Exception;

class VisitJob extends BaseObject implements \yii\queue\JobInterface
{

    /**
     * @var string
     */
    private string $shortLink;

    /**
     * @param $shotLink
     */
    public function __construct($shotLink)
    {
        $this->shortLink = $shotLink;
    }

    /**
     * @param $queue
     * @return void
     * @throws Exception
     */
    public function execute($queue)
    {
        if ($link = Link::findOne(['short_link' => $this->shortLink])) {
            $visit = new Visit();
            $visit->created_at = time();
            $visit->link_id = $link->id;
            $visit->save();
        }
    }
}
