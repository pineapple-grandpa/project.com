<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 25.09.18
 * Time: 12:49
 */

namespace app\modules\user\services;

use app\models\Comment;
use app\services\RequestService;

class CommentService
{
    /**
     * @var RequestService
     */
    private $requestService;

    /**
     * CommentService constructor.
     * @param RequestService $requestService
     */
    public function __construct(
        RequestService $requestService
    )
    {
        $this->requestService = $requestService;
    }

    public function saveChanges()
    {
        $data = $this->requestService->getFormBodyParams('CommentForm');

        if ($data) {
            $comment = Comment::findOne($data['comment_id']);
            $comment->message = $data['message'];
            return $comment->save();
        }

        return false;
    }

    public function saveNew($model)
    {
        if($model->load($this->requestService->getRequest()->post()) && $model->validate()){
            $comment = new Comment();
            $comment->parent_id = $model->parent_id;
            $comment->author_id = $model->author_id;
            $comment->author_name = $model->author_name;
            $comment->author_avatar = $model->author_avatar;
            $comment->message = $model->message;

            return $comment->save();
        }

        return false;
    }

    public function delete($id)
    {
        $comment = Comment::findOne($id);
        return $comment->delete();
    }


}