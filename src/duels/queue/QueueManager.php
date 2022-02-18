<?php

namespace duels\queue;

class QueueManager
{
    
    private static array $queues = [];

    public static function addToQueue(QueueInstance $instance):void
    {
        
        self::$queues[] = $instance;
        
    }

    /**
     * @return array
     */
    public static function getQueues(): array
    {
        return self::$queues;
    }

    public static function getFirst():QueueInstance
    {

        $queue = self::$queues[0];

        array_shift(self::$queues);

        return $queue;

    }

}