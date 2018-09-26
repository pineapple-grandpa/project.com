<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 13:12
 */

namespace app\modules\user\controllers;

use app\modules\user\Module;
use app\modules\user\services\ArticleService;
use yii\web\Controller;


/**
 * Class ArticleController
 *
 * @package app\modules\user\controllers
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    public $articleService;

    /**
     * ArticleController constructor.
     * @param $id
     * @param Module $module
     * @param ArticleService $articleService
     * @param array $config
     */
    public function __construct(
        $id,
        Module $module,
        ArticleService $articleService,
        array $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->articleService = $articleService;
    }

    /**
     * method for remove articles
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->articleService->delete($id);
    }

    /**
     * method for save articles
     */
    public function actionSave()
    {
        $this->articleService->saveChanges();
    }

}