<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="/css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>
	<body>
    <form action="/dd">
        <?php echo csrf_field(); ?>
    </form>
    <form action="/fdv">
        <?php echo csrf_field(); ?>
    </form>
		<div id="wrapper">
			<h1>Объявления</h1>
            <form>
                <div class="page-header">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="btn" href="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </form>

            <?php $__currentLoopData = $advertisements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertisement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route('update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="note">
                        <p>
                            <span class="date"><?php echo e($advertisement->created_at); ?></span>
                            <span class="name"><?php echo e($advertisement->name); ?></span>
                        </p>
                        <p><?php echo e($advertisement->description); ?></p>
                    </div>
                    <input class="d-none" name="id" value="<?php echo e($advertisement->id); ?>">
                    <?php
                    ?>
                    <button class="btn-default">UP</button>
                </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>

    <?php if($utility_collection['is_first']): ?>
        <form action="<?php echo e(route('store')); ?>" method="POST">

            <?php echo csrf_field(); ?>

            <div class="row" style="width: 500px;" >
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <input class="" name="category_id" value="<?php echo e($utility_collection['category']); ?>">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <h1>Выберите категорию</h1>
    <?php endif; ?>
	</body>
</html>

<?php /**PATH C:\OSPanel\domains\localhost\resources\views/index.blade.php ENDPATH**/ ?>