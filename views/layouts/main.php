<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'PDepartment',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'О нас', 'url' => ['/site/about']],
            Yii::$app->user->isGuest
            ? ['label' => 'Регистрация', 'url' => ['/site/register']] : '',
            !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin ? ['label' => 'Панель управления', 'url' => ['/admin']] : '',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ? ['label' => 'Сотрудники', 'url' => ['/employee']] : '',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ? ['label' => 'Приказы', 'url' => ['/order']] : '',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ?
            [
                'label' => 'Учет',
                'items' => [
                     ['label' => 'Учет рабочего времени', 'url' => '/time'],
                     ['label' => 'Учет больничных', 'url' => '/hospital'],
                     ['label' => 'Учет отпусков', 'url' => '/vacation'],
                ],
            ]
            : '',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ?
            [
                'label' => 'Статистика',
                'items' => [
                     ['label' => 'Статистика по рабочему времени', 'url' => '/time/index2'],
                     ['label' => 'Статистика по больничным', 'url' => '/hospital/index2'],
                     ['label' => 'Статистика по отпускам', 'url' => '/vacation/index2'],
                ],
            ]
            : '',
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin ?
            ['label' => 'Переводы', 'url' => ['/transfer']] : '',
            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; PDepartment <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
