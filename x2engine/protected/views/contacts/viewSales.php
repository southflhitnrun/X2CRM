<?php
/*********************************************************************************
 * The X2CRM by X2Engine Inc. is free software. It is released under the terms of 
 * the following BSD License.
 * http://www.opensource.org/licenses/BSD-3-Clause
 * 
 * X2Engine Inc.
 * P.O. Box 66752
 * Scotts Valley, California 95066 USA
 * 
 * Company website: http://www.x2engine.com 
 * Community and support website: http://www.x2community.com 
 * 
 * Copyright © 2011-2012 by X2Engine Inc. www.X2Engine.com
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * - Redistributions of source code must retain the above copyright notice, this 
 *   list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, this 
 *   list of conditions and the following disclaimer in the documentation and/or 
 *   other materials provided with the distribution.
 * - Neither the name of X2Engine or X2CRM nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
 * IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, 
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE 
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 ********************************************************************************/

$this->menu=array(
	array('label'=>Yii::t('contacts','All Contacts'),'url'=>array('index')),
	array('label'=>Yii::t('contacts','Lists'),'url'=>array('lists')),
	array('label'=>Yii::t('contacts','Create'),'url'=>array('create')),
	array('label'=>Yii::t('contacts','View'),'url'=>array('view','id'=>$model->id)),
	array('label'=>Yii::t('contacts','Share'),'url'=>array('shareContact','id'=>$model->id)),
);
if (Yii::app()->user->getName() == $model->assignedTo || Yii::app()->user->getName() == 'admin' || $model->assignedTo == 'Anyone') {
	$this->menu[] = array('label'=>Yii::t('contacts','Update'),'url'=>array('update', 'id'=>$model->id));
	$this->menu[] = array('label'=>Yii::t('contacts','Delete'),'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
}
?>

<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'baseScriptUrl'=>Yii::app()->request->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/gridview',
	'template'=> '<h2>'.Yii::t('sales','Sales for Contact: '.$model->name).'</h2><div class="title-bar">'
		.'{summary}</div>{items}{pager}',
	'dataProvider'=>new CArrayDataProvider($sales),
	'columns'=>array(
		array(
			'name'=>'name',
                        'header'=>Yii::t("sales",'Name'),
			'value'=>'CHtml::link($data->name,array("sales/view","id"=>$data->id))',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'40%'),
		),
		//'description',
		array(
			'name'=>'quoteAmount',
                        'header'=>Yii::t("sales",'Quote Amount'),
			'value'=>'Yii::app()->locale->numberFormatter->formatCurrency($data->quoteAmount,Yii::app()->params->currency)',
			'type'=>'raw',
		),
		array(
			'name'=>'salesStage',
                        'header'=>Yii::t("sales",'Sales Stage'),
			'value'=>'Yii::t("sales",$data->salesStage)',
			'type'=>'raw',
		),
		
		array(
			'name'=>'expectedCloseDate',
                        'header'=>Yii::t("sales",'Expected Close Date'),
			'value'=>'empty($data->expectedCloseDate)?"":date("Y-m-d",$data->expectedCloseDate)',
			'type'=>'raw',
			'htmlOptions'=>array('width'=>'13%'),
		),
                array(
                    'name'=>'probability',
                    'header'=>Yii::t("sales",'Probability'),
                    'value'=>'$data->probability',
                    'type'=>'raw',
                ),
		array(
			'name'=>'assignedTo',
                        'header'=>Yii::t("sales",'Assigned To'),
			'value'=>'empty($data->assignedTo)?Yii::t("app","Anyone"):$data->assignedTo',
			'type'=>'raw',
		),
		/*
		'leadSource',
		
		'createDate',
		'notes',
		*/
	),
));