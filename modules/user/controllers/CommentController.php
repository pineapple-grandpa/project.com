<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 20.09.18
 * Time: 15:49
 */

namespace app\modules\user\controllers;

use app\modules\user\Module;
use app\modules\user\services\CommentService;
use yii\web\Controller;

class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     * @param $id
     * @param Module $module
     * @param CommentService $commentService
     * @param array $config
     */
    public function __construct(
        $id,
        Module $module,
        CommentService $commentService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->commentService = $commentService;
    }

    /**
     * method for remove comments
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->commentService->delete($id);
    }

    /**
     * method for save comments
     */
    public function actionSave()
    {
        $this->commentService->saveChanges();
    }

}