<div class="issues-list">
	<div class="row">
		<?php  
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'issue_item',
                        //'id' => 'list-wrapper',
                    ],
                   // 'layout' => "{pager}\n{items}\n{summary}",
                    'itemView' => 'issue_list_item',
                ]);
        ?>
	</div>
</div>