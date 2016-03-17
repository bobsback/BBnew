<?php

/**
 * This file is part of Ajax Comment System for Laravel™.
 *
 * (c) HazzardWeb <hazzardweb@gmail.com>
 *
 * For the full copyright and license information, please visit:
 * http://codecanyon.net/licenses/standard
 */

namespace Hazzard\Comments\Jobs;

use Hazzard\Comments\Author\Author;
use Hazzard\Comments\Comments\Vote;
use Hazzard\Comments\Comments\Comment;
use Illuminate\Contracts\Bus\SelfHandling;

class VoteComment extends Job implements SelfHandling
{
    /**
     * @var \Hazzard\Comments\Comments\Comment
     */
    protected $comment;

    /**
     * @var string
     */
    protected $type;

    public $ip;

    /**
     * Create a new job instance.
     *
     * @param  \Hazzard\Comments\Comments\Comment  $comment
     * @param  string $type
     * @return void
     */
    public function __construct($comment, $type)
    {
        $this->type = $type;
        $this->comment = $comment;
        $this->ip = 666;
    }

    /**
     * Execute the job.
     *
     * @param  \Hazzard\Comments\Author\Author $author
     * @return void
     */
    public function handle(Author $author)
    {
        $ipAddress = ip2long(\Request::ip());

        $comment = $this->comment;

        if (! in_array($this->type, [Vote::UP, Vote::DOWN, Vote::REMOVE])) {
            return;
        }

        if ($author) {
            $vote = $comment->votes()->where('user_id', $author->id())->first();
        } else {
            $vote = $comment->votes()->where('user_id', null)->where('ip', $ipAddress)->first();
        }

        if ($vote) {
            if ($this->type === Vote::REMOVE) {
                $comment->decrement($vote->type === Vote::UP ? 'upvotes' : 'downvotes');
                $vote->delete();
            } elseif ($this->type !== $vote->type) {
                if ($this->type === Vote::UP) {
                    $comment->increment('upvotes');
                    $comment->decrement('downvotes');
                } elseif ($this->type === Vote::DOWN) {
                    $comment->decrement('upvotes');
                    $comment->increment('downvotes');
                }

                $vote->type = $this->type;

                $vote->save();
            }
        } else {
            $comment->votes()->save(new Vote([
                'user_id' => $author->id(),
                'type'    => $this->type,
                'ip'      => $ipAddress
            ]));

            $comment->increment($this->type === Vote::UP ? 'upvotes' : 'downvotes');
        }
    }
}
