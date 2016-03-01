<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/css/bootstrap-datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.form.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/adminBooking.js', CClientScript::POS_END);
$urlUploadFile = $this->createUrl("adminbooking/ajaxUploadFile");
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlReturn = $this->createUrl('adminbooking/view', array('id' => ''));
$urlSubmit = $this->createUrl('adminbooking/ajaxCreate');
$urlLoadCity = $this->createUrl('region/loadCities');
?>
<h1 class="">预约患者</h1>
<style>
    .border-bottom{border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;}
    .tab-header{display: inline-block;min-width: 6em;}
    .with20{width: 20%;float: left;}
    .form-group{width: 100%;border-bottom: 1px solid #ddd;margin-bottom: 5px;padding-bottom: 5px;padding-top: 5px;}
    .form-control{display: inline-block;width: auto;}
    .w50{width: 50%;}
    .w100{width: 100%;}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'booking-form',
    'htmlOptions' => array('class' => 'form-horizontal', 'data-url-return' => $urlReturn, 'data-url-action' => $urlSubmit, 'data-url-uploadFile' => $urlUploadFile),
    'enableAjaxValidation' => false,
        ));
?>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">客户编号：</span><?php echo $form->textField($model, 'ref_no', array('class' => 'form-control w50')); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">患者姓名：</span><?php echo $form->textField($model, 'patient_name', array('class' => 'form-control w50')); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">患者电话：</span><?php echo $form->textField($model, 'patient_mobile', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">年龄：</span><?php echo $form->textField($model, 'patient_age', array('class' => 'form-control w50')); ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">身份证：</span><?php echo $form->textField($model, 'patient_identity', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">地址：</span><?php
            echo $form->dropDownList($model, 'state_id', $model->loadOptionsState(), array(
                'name' => 'AdminBookingForm[state_id]',
                'prompt' => '选择省份',
                'class' => 'form-control w50',
            ));
            ?> 省/市
        </div>
        <div class="col-md-3">
            <?php
            echo $form->dropDownList($model, 'city_id', $model->loadOptionsCity(), array(
                'name' => 'AdminBookingForm[city_id]',
                'prompt' => '选择城市',
                'class' => 'form-control w50',
            ));
            ?> 市
        </div>
        <div class="col-md-4">
            <?php echo $form->textField($model, 'patient_address', array('class' => 'form-control w100')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">疾病诊断：</span><?php echo $form->textField($model, 'disease_name', array('class' => 'form-control w50')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">病情描述：</span><?php echo $form->textArea($model, 'disease_detail', array('class' => 'form-control w50', 'maxlength' => 1000)); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <span class="tab-header">期望手术时间：</span><?php echo $form->textField($model, 'expected_time_start', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?> — <?php echo $form->textField($model, 'expected_time_end', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <h3>病历附件&nbsp;&nbsp;&nbsp;</h3>
    <div class="mb20 row">
        <div class="col-sm-6">
            <div id="uploaderBooking" class="mt20 uploader">
                <div class="imglist">
                    <ul class="filelist"></ul>
                </div>
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                    </div>
                </div>
                <div class="statusBar clearfix" style="display:none;">
                    <div class="progress" style="display: none;">
                        <span class="text">0%</span>
                        <span class="percentage" style="width: 0%;"></span>
                    </div>
                    <div class="info">共0张（0B），已上传0张</div>
                    <div class="">
                        <!-- btn 继续添加 -->
                        <div id="filePicker2" class=""></div>                          
                    </div>
                    <!--                    <div class="mt40 clearfix">
                                            <button id="btnSubmit" class="statusBar uploadBtn btn btn-primary col-sm-4 col-sm-offset-1">提交</button>
                                        </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-md-4">
            <span class="tab-header">理想医院：</span><?php
            echo $form->dropDownList($model, 'expected_hospital_id', $model->loadOptionsHospital(), array(
                'name' => 'AdminBookingForm[expected_hospital_id]',
                'prompt' => '选择医院',
                'class' => 'form-control w50',
            ));
            ?>
        </div>
        <div class="col-md-4">
            <span class="tab-header">理想科室：</span><select class="sel form-control w50" name="AdminBookingForm[expected_hp_dept_id]" id="AdminBookingForm_expected_hp_dept_id">
                <option value="">-- 无 --</option>
            </select>
        </div>
        <div class="col-md-4">
            <span class="tab-header">理想专家：</span><?php echo $form->textField($model, 'experted_doctor_name', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <span class="tab-header">最终手术的医生：</span><?php
            echo $form->dropDownList($model, 'final_doctor_id', $model->loadOptionsDoctorProfile(), array(
                'name' => 'AdminBookingForm[final_doctor_id]',
                'prompt' => '选择医生',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-md-6">
            <span class="tab-header">最终手术时间：</span><?php echo $form->textField($model, 'final_time', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="form-group">
        <div class="col-sm-12">
            <div class="with20">
                <span>是否确诊：</span><select class="form-control" name="AdminBookingForm[disease_confirm]" id="AdminBookingForm_disease_confirm">
                    <option value>--选择--</option>
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
            <div class="with20">
                <span>患者目的：</span><?php
                echo $form->dropDownList($model, 'customer_request', $model->loadOptionsCustomerRequest(), array(
                    'name' => 'AdminBookingForm[customer_request]',
                    'prompt' => '选择',
                    'class' => 'form-control',
                ));
                ?>
            </div>
            <div class="with20">
                <span>客户意向：</span><?php
                echo $form->dropDownList($model, 'customer_intention', $model->loadOptionsCustomerIntention(), array(
                    'name' => 'AdminBookingForm[customer_intention]',
                    'prompt' => '选择',
                    'class' => 'form-control',
                ));
                ?>
            </div>
            <div class="with20">
                <span>客户类型：</span><?php
                echo $form->dropDownList($model, 'customer_type', $model->loadOptionsCustomerType(), array(
                    'name' => 'AdminBookingForm[customer_type]',
                    'prompt' => '选择',
                    'class' => 'form-control',
                ));
                ?>
            </div>
            <div class="with20">
                <span>导流来源：</span><?php
                echo $form->dropDownList($model, 'customer_diversion', $model->loadOptionsCustomerDiversion(), array(
                    'name' => 'AdminBookingForm[customer_diversion]',
                    'prompt' => '选择',
                    'class' => 'form-control',
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <span>跟进状态：</span><?php
            echo $form->dropDownList($model, 'booking_status', $model->loadOptionsBookingStatus(), array(
                'name' => 'AdminBookingForm[booking_status]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-4">
            <span>付费状态：</span><select class="form-control" name="AdminBookingForm[order_status]" id="AdminBookingForm_order_status">
                <option value>--选择--</option>
                <option value="1">已付费</option>
                <option value="0">未付费</option>
            </select>
        </div>
        <div class="col-sm-4">
            <span>付费金额：</span><?php echo $form->textField($model, 'order_amount', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <span>录入日期：</span><?php echo $form->textField($model, 'final_time', array('class' => 'form-control datepicker', 'data-format' => 'yyyy-mm-dd', 'readonly' => true)); ?>
        </div>
        <div class="col-sm-4">
            <span>业务员：</span><?php
            echo $form->dropDownList($model, 'admin_user_id', $model->loadOptionsAdminUser(), array(
                'name' => 'AdminBookingForm[admin_user_id]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
        <div class="col-sm-4">
            <span>客户来源：</span><?php
            echo $form->dropDownList($model, 'customer_agent', $model->loadOptionsCustomerAgent(), array(
                'name' => 'AdminBookingForm[customer_agent]',
                'prompt' => '选择',
                'class' => 'form-control',
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <span>特殊备注：</span><?php echo $form->textArea($model, 'remark', array('class' => 'form-control w50', 'maxlength' => 1000)); ?>
        </div>
    </div>
</div>
<div class="mt30">
    <div class="buttons">
        <button id="btnSubmitForm" class="btn btn-primary" type="button" name="yt0">保存</button>
        <?php //echo CHtml::submitButton('保存', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function () {
        $(".datepicker").datepicker({
            startDate: "+1d",
            todayBtn: true,
            autoclose: true,
            maxView: 3,
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $("select#AdminBookingForm_state_id").change(function () {
            //$("select#city_id_id").attr("disabled", true);
            var stateId = $(this).val();
            var actionUrl = "<?php echo $urlLoadCity; ?>";// + stateId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                data: {'state': this.value, 'prompt': '选择城市'},
                cache: false,
                // dataType: "html",
                'success': function (data) {
                    $("select#AdminBookingForm_city_id").html(data);
                    // jquery mobile fix.
                    captionText = $("select#AdminBookingForm_city_id>option:first-child").text();
                    $("#AdminBookingForm_city_id-button>span:first-child").text(captionText);
                },
                'error': function (data) {
                },
                complete: function () {
                    //$("select#city_id_id").attr("disabled", false);
                }
            });
            return false;
        });
        $("select#AdminBookingForm_expected_hospital_id").change(function () {
            $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", true);
            var hopitalId = $(this).val();
            var actionUrl = "<?php echo $urlAjaxLoadloadHospitalDept; ?>/" + hopitalId;// + hopitalId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                //cache: false,
                //dataType: "html",
                'success': function (data) {
                    $("select#AdminBookingForm_expected_hp_dept_id").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#AdminBookingForm_expected_hp_dept_id").attr("disabled", false);
                }
            });
            return false;
        });
    });
</script> 