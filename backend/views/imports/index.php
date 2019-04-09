<?php
use yii\widgets\ActiveForm;

?>
<input type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModal" id="import" value="导入excell" />
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php $form = ActiveForm::begin(); ?>
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    导入Excel
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-sm-9">
                                <?= $form->field($model, 'file')->fileInput() ?>
                                <span class="Validform_checktip"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id='formbtn'  class="btn btn-primary">
                    提交保存
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    关闭
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    <?php ActiveForm::end(); ?>
</div>
