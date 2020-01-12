<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 25.09.18
 * Time: 10:52
 */

namespace app\modules\user\services;


use app\models\Article;
use app\modules\user\models\ArticleForm;
use app\services\RequestService;

class ArticleService
{
    protected $data;

    /**
     * @var RequestService
     */
    private $requestService;

    /**
     * ArticleService constructor.
     * @param RequestService $requestService
     */
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function saveNew($model)
    {
        if($model->load($this->requestService->getRequest()->post()) && $model->validate()){
            $article = new Article();
            $article->user_id = $model->user_id;
            $article->author_id = $model->author_id;
            $article->author_name = $model->author_name;
            $article->author_avatar = $model->author_avatar;
            $article->message = $model->message;

            return $article->save();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function saveChanges()
    {
        /** @var array $data */
        $data = $this->requestService->getFormBodyParams('ArticleForm');

        if ($data){
            $article = Article::findOne($data['article_id']);
            $article->message = $data['message'];
            return $article->save();
        }

        return false;
    }

    public function delete($id)
    {
        $article = Article::findOne($id);

        return $article->delete();
    }

}