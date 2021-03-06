<?php namespace Lio\Comments;

use Lio\Core\EloquentBaseRepository;
use Lio\Forum\ForumCategory;
use Illuminate\Support\Collection;

class CommentRepository extends EloquentBaseRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getForumThreadsByTagsPaginated(Collection $tags, $perPage = 20)
    {
        $query = $this->model->with(['slug', 'mostRecentChild', 'tags'])
            ->where('type', '=', COMMENT::TYPE_FORUM)
            ->join('comment_tag', 'comments.id', '=', 'comment_tag.comment_id');

        if ($tags->count() > 0) {
            $query->whereIn('comment_tag.tag_id', $tags->lists('id'));            
        }

        $query->groupBy('comments.id')
            ->orderBy('created_at', 'desc');

        return $query->paginate($perPage, ['comments.*']);
    }

    public function getThreadCommentsPaginated(Comment $thread, $perPage = 20)
    {
    	return $this->model->where(function($q) use ($thread) {
    					$q->where(function($q) use ($thread) {
    						$q->where('id', '=', $thread->id);
    					});

    					$q->orWhere(function($q) use ($thread) {
    						$q->where('parent_id', '=', $thread->id);
    					});
    				})
    				->orderBy('created_at', 'asc')
    				->paginate($perPage);
    }

    public function getFeaturedForumThreads($count = 3)
    {
        return $this->model->with(['slug', 'tags'])
                   ->where('owner_type', '=', 'Lio\Forum\ForumCategory')
                   ->orderBy('created_at', 'desc')
                   ->take($count)
                   ->get();
    }

    public function getForumReplyForm()
    {
        return new ForumReplyForm;
    }

    public function getForumCreateForm()
    {
        return new ForumCreateForm;
    }

    public function requireForumThreadById($id)
    {
        $model = $this->model->where('id', '=', $id)->where('type', '=', COMMENT::TYPE_FORUM)->first();

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }
}