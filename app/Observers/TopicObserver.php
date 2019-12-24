<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        $topic->excrept = make_excerpt($topic->body);
    }

    public function updating(Topic $topic)
    {
        //
    }
}
