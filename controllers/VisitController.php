<?php

namespace app\controllers;

use app\commands\jobs\VisitJob;
use app\models\Link;
use app\models\Visit;
use app\models\VisitSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * VisitController implements the CRUD actions for Visit model.
 */
class VisitController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Visit models.
     *
     * @param int $id
     * @return string
     */
    public function actionIndex(int $id): string
    {
        $searchModel = new VisitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Visit short link.
     * @param string $shortLink
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionProcess(string $shortLink): Response
    {
        if ($link = Link::findOne(['short_link' => $shortLink])) {
            Yii::$app->queue->push(new VisitJob($shortLink));
            return $this->redirect($link->link);
        }

        throw new NotFoundHttpException();
    }
}
