<?php

namespace abdualiym\slider\controllers;

use abdualiym\slider\entities\Slide;
use abdualiym\slider\forms\SlideForm;
use abdualiym\slider\forms\SlideSearch;
use abdualiym\slider\Module;
use abdualiym\slider\repositories\SlideRepository;
use abdualiym\slider\services\SlideManageService;
use abdualiym\slider\services\TransactionManager;
use Yii;
use yii\base\Component;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * SlideController implements the CRUD actions for Slide model.
 */
class SlideController extends Controller
{
    private $service;

    public function __construct(string $id, Slider $module, SlideManageService $service, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'slide' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $form = new SlideForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $slide = $this->service->create($form);
                return $this->redirect(['view', 'id' => $slide->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('Create error.', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form
        ]);
    }


    public function actionUpdate($id)
    {
        $slide = $this->findModel($id);
        $form = new SlideForm($slide);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//        echo $form->load(Yii::$app->request->post());
//        $form->validate();
//        VarDumper::dump($form->getErrors(), 10, true);
//        die;
            try {
                $this->service->edit($slide->id, $form);
                return $this->redirect(['view', 'id' => $slide->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', ['model' => $form,
            'slide' => $slide,]);
    }


    /**
     * @param integer $id
     * @return mixed
     */
    public
    function actionActivate($id)
    {
        try {
            $this->service->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public
    function actionDraft($id)
    {
        try {
            $this->service->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }


    public
    function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the Slide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slide the loaded model
     * @throws \DomainException if the model cannot be found
     */
    protected
    function findModel($id): Slide
    {
        if (($model = Slide::findOne($id)) !== null) {
            return $model;
        }
        throw new \DomainException('The requested slide does not exist.');
    }
}
